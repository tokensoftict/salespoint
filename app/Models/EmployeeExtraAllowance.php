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
		'total_amount' => 'float'
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
		'comment'
	];

	public function allowance()
	{
		return $this->belongsTo(Allowance::class);
	}

	public function employee()
	{
		return $this->belongsTo(Employee::class);
	}
}
