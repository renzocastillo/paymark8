<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CmsLog
 * 
 * @property int $id
 * @property string|null $ipaddress
 * @property string|null $useragent
 * @property string|null $url
 * @property string|null $description
 * @property string|null $details
 * @property int|null $id_cms_users
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class CmsLog extends Model
{
	protected $table = 'cms_logs';

	protected $casts = [
		'id_cms_users' => 'int'
	];

	protected $fillable = [
		'ipaddress',
		'useragent',
		'url',
		'description',
		'details',
		'id_cms_users'
	];
}
