<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CmsNotification
 * 
 * @property int $id
 * @property int|null $id_cms_users
 * @property string|null $content
 * @property string|null $url
 * @property bool|null $is_read
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class CmsNotification extends Model
{
	protected $table = 'cms_notifications';

	protected $casts = [
		'id_cms_users' => 'int',
		'is_read' => 'bool'
	];

	protected $fillable = [
		'id_cms_users',
		'content',
		'url',
		'is_read'
	];
}
