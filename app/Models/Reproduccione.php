<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Reproduccione
 * 
 * @property int $id
 * @property int|null $ipaddress
 * @property int $cms_users_id
 * @property int $videos_id
 * @property Carbon|null $created_at
 * 
 * @property CmsUser $cms_user
 * @property Video $video
 *
 * @package App\Models
 */
class Reproduccione extends Model
{
	protected $table = 'reproducciones';
	public $timestamps = false;

	protected $casts = [
		'ipaddress' => 'int',
		'cms_users_id' => 'int',
		'videos_id' => 'int'
	];

	protected $fillable = [
		'ipaddress',
		'cms_users_id',
		'videos_id'
	];

	public function cms_user()
	{
		return $this->belongsTo(CmsUser::class, 'cms_users_id');
	}

	public function video()
	{
		return $this->belongsTo(Video::class, 'videos_id');
	}
}
