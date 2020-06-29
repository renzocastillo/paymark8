<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ModuleVideo
 * 
 * @property int $id
 * @property string $title
 * @property string $url
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $modules_id
 * 
 * @property Module $module
 *
 * @package App\Models
 */
class ModuleVideo extends Model
{
	protected $table = 'module_videos';

	protected $casts = [
		'modules_id' => 'int'
	];

	protected $fillable = [
		'title',
		'url',
		'modules_id'
	];

	public function module()
	{
		return $this->belongsTo(Module::class, 'modules_id');
	}
}
