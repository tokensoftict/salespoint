<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * Class PayrollPeriod
 *
 * @property int $id
 * @property Carbon $period
 * @property int $employee_count
 * @property string $status
 * @property float $gross_pay
 * @property float $gross_deduction
 * @property float $net_pay
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Collection|Payslip[] $payslips
 *
 * @package App\Models
 */
class PayrollPeriod extends Model
{
    protected $table = 'payroll_periods';

    protected $casts = [
        'employee_count' => 'int',
        'gross_pay' => 'float',
        'gross_deduction' => 'float',
        'net_pay' => 'float'
    ];



    protected $fillable = [
        'period',
        'employee_count',
        'status',
        'gross_pay',
        'gross_deduction',
        'net_pay',
        'current'
    ];

    protected $appends = ['period_date'];

    protected $with = ['payslips'];

    public function getPeriodDateAttribute()
    {
        return date('F Y',strtotime($this->period));
    }

    public function payslips()
    {
        return $this->hasMany(Payslip::class);
    }

    public function approve()
    {
        $this->status = 2;

        $this->update();
    }

    public function close()
    {
        //remove deductions and allowance that has end

        EmployeeExtraDeduction::where("end_date",$this->period)->update(['status'=>2,'comment'=>"Auto Stop"]);
        EmployeeExtraAllowance::where("end_date",$this->period)->update(['status'=>2,'comment'=>"Auto Stop"]);

        $this->rollPeriodsToNextMonth();

        $this->current = 0;

        $this->status = "3";

        $this->update();
    }

    public function rollPeriodsToNextMonth()
    {
        PayrollPeriod::create([
            'period' => date("Y-m-d", strtotime("+1 month", strtotime($this->period))),
            'employee_count' => 0,
            'status' => 1,
            'gross_pay' => 0,
            'gross_deduction' => 0,
            'net_pay' => 0,
        ]);
    }


    public function runPayroll()
    {
        $employee_count = 0;
        $gross_pay = 0;
        $gross_deduction = 0;
        $net_pay = 0;

        $core_allowance = Allowance::where('default',1)->pluck('id');
        $core_deduction = Deduction::where('default',1)->pluck('id');

        $employees = Employee::with(['bank','activeDeductions','activeAllowances',])->where("status",1)->get();

        $this->payslips()->delete();

        DB::transaction(function() use (&$employees,&$employee_count,&$gross_pay,&$gross_deduction,&$net_pay,&$core_allowance,&$core_deduction){

            foreach ($employees as $employee)
            {

                //for Allowance

                $employee_total_allowance = 0;

                $employee_extra_total_allowance = 0;

                $employee_allowance = [];

                $employee_allowance[] =  new PayslipsItem(
                    [
                        'payable_type' => Allowance::class,
                        'payable_id' => 1,
                        'item_type' =>1,
                        'amount' => $employee->salary
                    ]
                );

                $employee_total_allowance+=($employee->salary == "" ? 0 : $employee->salary);

                foreach ($employee->activeAllowances as $extra_allowance)
                {
                    $employee_total_allowance += $extra_allowance->pivot->amount;
                    $employee_extra_total_allowance +=$extra_allowance->pivot->amount;
                    $employee_allowance[] =  new PayslipsItem(
                        [
                            'payable_type' => EmployeeExtraAllowance::class,
                            'payable_id' => $extra_allowance->pivot->id,
                            'item_type' =>1,
                            'amount' => $extra_allowance->pivot->amount
                        ]
                    );

                }

                //for Deduction

                $employee_total_deduction = 0;

                $employee_deduction = [];

                foreach ($employee->activeDeductions as $extra_deduction)
                {
                    $employee_total_deduction += $extra_deduction->pivot->amount;

                    $employee_deduction[] = new PayslipsItem(
                        [
                            'payable_type' => EmployeeExtraDeduction::class,
                            'payable_id' => $extra_deduction->pivot->id,
                            'item_type' =>2,
                            'amount' => -$extra_deduction->pivot->amount
                        ]
                    );

                }


                $payslips = Payslip::create([
                    'payroll_period_id' => $this->id,
                    'employee_id' => $employee->id,
                    'scale_id' => $employee->scale_id,
                    'rank_id' => $employee->rank_id,
                    'designation_id' => $employee->designation_id,
                    'bank_id' => $employee->bank_id,
                    'account_name' => $employee->bank_account_name,
                    'account_no' => $employee->bank_account_no,
                    'gross_pay' =>  $employee_total_allowance,
                    'total_deduction' => -$employee_total_deduction,
                    'total_allowance' => $employee_extra_total_allowance,
                    'net_pay' => ($employee_total_allowance - $employee_total_deduction)
                ]);

                $payslips->payslips_items()->saveMany(array_merge($employee_allowance,$employee_deduction));

                $gross_pay+=$employee_total_allowance;
                $gross_deduction+=$employee_total_deduction;
                $net_pay+=($employee_total_allowance - $employee_total_deduction);
                $employee_count++;
            }

        });

        $this->gross_pay = $gross_pay;
        $this->gross_deduction = $gross_deduction;
        $this->net_pay = $net_pay;
        $this->employee_count = $this->payslips()->count();

        $this->update();

        return $this;
    }

}
