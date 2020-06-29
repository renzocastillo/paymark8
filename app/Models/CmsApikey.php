<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CmsApikey
 * 
 * @property int $id
 * @property string|null $screetkey
 * @property int|null $hit
 * @property string $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class CmsApikey extends Model
{
	protected $table = 'cms_apikey';

	protected $casts = [
		'hit' => 'int'
	];

	protected $fillable = [
		'screetkey',
		'hit',
		'status'
	];
}
