<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EmployeeExtraAllowance
 *
 * @property int $id
 * @property int $employee_id
 * @property int $allowance_id
 * @property float $percent
 * @property float $amount
 * @property float $total_amount
 * @property Carbon|null $start_date
 * @property Carbon|null $end_date
 * @property string $status
 * @property string|null $comment
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Allowance $allowance
 * @property Employee $employee
 *
 * @package App\Models
 */
class EmployeeExtraAllowance extends Model
{
    protected $table = 'employee_extra_allowances';

    protected $casts = [
        'employee_id' => 'int',
        'allowance_id' => 'int',
        'percent' => 'float',
        'amount' => 'float',
        'total_amount' => 'float',
        'tenure' => 'int'
    ];

    protected $dates = [
        'start_date',
        'end_date'
    ];

    protected $fillable = [
        'employee_id',
        'allowance_id',
        'percent',
        'amount',
        'total_amount',
        'start_date',
        'end_date',
        'status',
        'comment',
        'tenure'
    ];

    public function allowance()
    {
        return $this->belongsTo(Allowance::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public static function createExtraAllowance($request)
    {
        $employees = Employee::whereIn("id",$request->get('employee_id'))->get();
        foreach ($employees as $employee) {

            if($employee->salary == 0 && $request->get("type") == "0" ) continue;
            if(!is_numeric($request->get("tenure"))) continue;

            if(!is_numeric($request->get("amount"))) continue;

            EmployeeExtraAllowance::create(
                [
                    'employee_id' => $employee->id,
                    'allowance_id' => $request->get('allowance_id'),
                    'percent' => $request->get("type") == "0" ?  $request->get('amount') : 0,
                    'amount' => $request->get("type") == "1" ? $request->get('amount') : round(((((float)$request->get("amount"))/100) * $employee->salary),2),
                    'tenure' => $request->get("tenure"),
                    'start_date' => $request->get("start_date"),
                    'end_date' => $request->get("tenure") < 1 ? NULL : date('Y-m-d',strtotime("+ ".($request->get("tenure") -1)." months",strtotime($request->get("start_date")))),
                    'status' => '1',
                    'comment' => $request->get("tenure") < 1 ? "Run indefinitely" : NULL,
                    'total_amount' => $request->get("tenure") < 1 ? $request->get('amount') : ($request->get("tenure") * ($request->get("type") == "1" ? $request->get('amount') : round(((((float)$request->get("amount"))/100) * $employee->salary),2)))
                ]
            );
        }
    }

    public function stop()
    {
        $this->status = 3;
        $this->comment = "Manual Stop By ".auth()->user()->name;
        $this->update();
    }

    public function item()
    {
        return $this->morphOne(PayslipsItem::class,'payable');
    }

}
