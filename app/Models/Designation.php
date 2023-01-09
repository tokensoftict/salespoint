<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Designation
 *
 * @property int $id
 * @property string $name
 * @property bool $enabled
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Collection|Employee[] $employees
 * @property Collection|Payslip[] $payslips
 *
 * @package App\Models
 */
class Designation extends Model
{
	protected $table = 'designations';

	protected $casts = [
		'enabled' => 'bool'
	];

	protected $fillable = [
		'name',
		'enabled'
	];


    public static $fields  = [
        'name',
        'enabled'
    ];

    public static $validation  = [
        'name' => 'required'
    ];

	public function employees()
	{
		return $this->hasMany(Employee::class);
	}

	public function payslips()
	{
		return $this->hasMany(Payslip::class);
	}
}
