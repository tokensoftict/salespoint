<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Payslip
 *
 * @property int $id
 * @property int $payroll_period_id
 * @property int $employee_id
 * @property int|null $scale_id
 * @property int|null $rank_id
 * @property int|null $designation_id
 * @property int|null $bank_id
 * @property string|null $account_name
 * @property string|null $account_no
 * @property float $gross_pay
 * @property float $total_deduction
 * @property float $total_allowance
 * @property float $net_pay
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Bank|null $bank
 * @property Designation|null $designation
 * @property Employee $employee
 * @property PayrollPeriod $payroll_period
 * @property Rank|null $rank
 * @property Scale|null $scale
 * @property Collection|PayslipsItem[] $payslips_items
 *
 * @package App\Models
 */
class Payslip extends Model
{
	protected $table = 'payslips';

	protected $casts = [
		'payroll_period_id' => 'int',
		'employee_id' => 'int',
		'scale_id' => 'int',
		'rank_id' => 'int',
		'designation_id' => 'int',
		'bank_id' => 'int',
		'gross_pay' => 'float',
		'total_deduction' => 'float',
        'total_allowance' => 'float',
		'net_pay' => 'float'
	];

	protected $fillable = [
		'payroll_period_id',
		'employee_id',
		'scale_id',
		'rank_id',
		'designation_id',
		'bank_id',
		'account_name',
		'account_no',
		'gross_pay',
		'total_deduction',
        'total_allowance',
		'net_pay'
	];

    protected $with = ['bank','designation','employee','rank','scale','payslips_items'];

	public function bank()
	{
		return $this->belongsTo(Bank::class);
	}

	public function designation()
	{
		return $this->belongsTo(Designation::class);
	}

	public function employee()
	{
		return $this->belongsTo(Employee::class);
	}

	public function payroll_period()
	{
		return $this->belongsTo(PayrollPeriod::class);
	}

	public function rank()
	{
		return $this->belongsTo(Rank::class);
	}

	public function scale()
	{
		return $this->belongsTo(Scale::class);
	}

	public function payslips_items()
	{
		return $this->hasMany(PayslipsItem::class);
	}
}
