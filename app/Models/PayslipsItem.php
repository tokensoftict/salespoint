<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PayslipsItem
 * 
 * @property int $id
 * @property int $payslip_id
 * @property string $payable_type
 * @property int $payable_id
 * @property string|null $item_type
 * @property float $amount
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Payslip $payslip
 *
 * @package App\Models
 */
class PayslipsItem extends Model
{
	protected $table = 'payslips_items';

	protected $casts = [
		'payslip_id' => 'int',
		'payable_id' => 'int',
		'amount' => 'float'
	];

	protected $fillable = [
		'payslip_id',
		'payable_type',
		'payable_id',
		'item_type',
		'amount'
	];

	public function payslip()
	{
		return $this->belongsTo(Payslip::class);
	}
}
