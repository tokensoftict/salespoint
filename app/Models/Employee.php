<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Employee
 * 
 * @property int $id
 * @property string $employee_no
 * @property string $surname
 * @property string|null $other_names
 * @property string|null $gender
 * @property Carbon|null $dob
 * @property string|null $email
 * @property string|null $phone
 * @property string|null $address
 * @property string|null $marital_status
 * @property string|null $photo
 * @property bool $status
 * @property int|null $scale_id
 * @property int|null $rank_id
 * @property int|null $designation_id
 * @property int|null $bank_id
 * @property string|null $bank_account_no
 * @property string|null $bank_account_name
 * @property float $salary
 * @property bool $permanent
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Bank|null $bank
 * @property Designation|null $designation
 * @property Rank|null $rank
 * @property Scale|null $scale
 * @property Collection|Allowance[] $allowances
 * @property Collection|Deduction[] $deductions
 * @property Collection|Payslip[] $payslips
 *
 * @package App\Models
 */
class Employee extends Model
{
	protected $table = 'employees';

	protected $casts = [
		'status' => 'bool',
		'scale_id' => 'int',
		'rank_id' => 'int',
		'designation_id' => 'int',
		'bank_id' => 'int',
		'salary' => 'float',
		'permanent' => 'bool'
	];

	protected $dates = [
		'dob'
	];

	protected $fillable = [
		'employee_no',
		'surname',
		'other_names',
		'gender',
		'dob',
		'email',
		'phone',
		'address',
		'marital_status',
		'photo',
		'status',
		'scale_id',
		'rank_id',
		'designation_id',
		'bank_id',
		'bank_account_no',
		'bank_account_name',
		'salary',
		'permanent'
	];

	public function bank()
	{
		return $this->belongsTo(Bank::class);
	}

	public function designation()
	{
		return $this->belongsTo(Designation::class);
	}

	public function rank()
	{
		return $this->belongsTo(Rank::class);
	}

	public function scale()
	{
		return $this->belongsTo(Scale::class);
	}

	public function allowances()
	{
		return $this->belongsToMany(Allowance::class, 'employee_extra_allowances')
					->withPivot('id', 'percent', 'amount', 'total_amount', 'start_date', 'end_date', 'status', 'comment')
					->withTimestamps();
	}

	public function deductions()
	{
		return $this->belongsToMany(Deduction::class, 'employee_extra_deductions')
					->withPivot('id', 'percent', 'amount', 'total_amount', 'start_date', 'end_date', 'status', 'comment')
					->withTimestamps();
	}

	public function payslips()
	{
		return $this->hasMany(Payslip::class);
	}
}
