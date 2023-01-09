<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

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

	protected $dates = [
		'period'
	];

	protected $fillable = [
		'period',
		'employee_count',
		'status',
		'gross_pay',
		'gross_deduction',
		'net_pay'
	];

	public function payslips()
	{
		return $this->hasMany(Payslip::class);
	}
}
