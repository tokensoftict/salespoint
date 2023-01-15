<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Allowance
 *
 * @property int $id
 * @property string $name
 * @property string|null $slug
 * @property bool $default
 * @property bool $enabled
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Collection|Employee[] $employees
 *
 * @package App\Models
 */
class Allowance extends Model
{
	protected $table = 'allowances';

	protected $casts = [
		'default' => 'bool',
		'enabled' => 'bool',
	];

	protected $fillable = [
		'name',
		'slug',
		'default',
		'enabled'
	];


    public static $fields  = [
        'name',
        'enabled',
        'default'
    ];

    public static $validation  = [
        'name' => 'required'
    ];


	public function employees()
	{
		return $this->belongsToMany(Employee::class, 'employee_extra_allowances')
					->withPivot('id', 'percent', 'amount', 'total_amount', 'start_date', 'end_date', 'status', 'comment')
					->withTimestamps();
	}

    public function item()
    {
        return $this->morphOne(PayslipsItem::class,'payable');
    }
}
