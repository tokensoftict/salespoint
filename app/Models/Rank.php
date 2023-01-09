<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Rank
 *
 * @property int $id
 * @property string $name
 * @property bool $permanent
 * @property int $next_rank_id
 * @property float $salary
 * @property bool $enabled
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Collection|Employee[] $employees
 * @property Collection|Payslip[] $payslips
 *
 * @package App\Models
 */
class Rank extends Model
{
	protected $table = 'ranks';

	protected $casts = [
		'permanent' => 'bool',
		'next_rank_id' => 'int',
		'salary' => 'float',
		'enabled' => 'bool'
	];

	protected $fillable = [
		'name',
		'permanent',
		'next_rank_id',
		'salary',
		'enabled'
	];

    public static $fields = [
        'name',
        'permanent',
        'next_rank_id',
        'salary',
        'enabled'
    ];

    public static $validation = [
        'name' => 'required',
        'salary' => 'required'
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
