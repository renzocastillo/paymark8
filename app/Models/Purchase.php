<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Purchase
 * 
 * @property int $id
 * @property int $user_id
 * @property float $amount
 * @property string $status
 * @property string|null $eci_code
 * @property string|null $eci_description
 * @property string|null $transaction_id
 * @property string|null $signature
 * @property string|null $transaction_invoice
 * @property Carbon|null $transaction_date
 * @property string|null $transaction_currency
 * @property float|null $transaction_amount
 * @property string|null $card
 * @property string|null $action_description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property CmsUser $cms_user
 *
 * @package App\Models
 */
class Purchase extends Model
{
	protected $table = 'purchases';

	protected $casts = [
		'user_id' => 'int',
		'amount' => 'float',
		'transaction_amount' => 'float'
	];

	protected $dates = [
		'transaction_date'
	];

	protected $fillable = [
		'user_id',
		'amount',
		'status',
		'eci_code',
		'eci_description',
		'transaction_id',
		'signature',
		'transaction_invoice',
		'transaction_date',
		'transaction_currency',
		'transaction_amount',
		'card',
		'action_description'
	];

	public function cms_user()
	{
		return $this->belongsTo(CmsUser::class, 'user_id');
	}
}
