<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SalesRepresentative
 *
 * @property int $id
 * @property string|null $fullname
 * @property string|null $username
 * @property string|null $email_address
 * @property string|null $address
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Collection|Invoice[] $invoices
 * @property Collection|Payment[] $payments
 *
 * @package App\Models
 */
class SalesRepresentative extends Model
{
	protected $table = 'sales_representatives';

	protected $fillable = [
		'fullname',
		'username',
		'email_address',
		'address',
        'status'
	];

    public static $fields = [
        'fullname',
        'username',
        'email_address',
        'address',
        'status'
    ];

    public static $validate = [
        'fullname' => "required",
        'email_address' => "required",
        'username' => "required",
    ];

	public function invoices()
	{
		return $this->hasMany(Invoice::class);
	}

	public function payments()
	{
		return $this->hasMany(Payment::class);
	}
}
