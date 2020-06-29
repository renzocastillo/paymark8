<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Module
 * 
 * @property int $id
 * @property string $title
 * @property string $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $course_id
 * 
 * @property Course $course
 * @property Collection|ModuleFile[] $module_files
 * @property Collection|ModuleVideo[] $module_videos
 *
 * @package App\Models
 */
class Module extends Model
{
	protected $table = 'modules';

	protected $casts = [
		'course_id' => 'int'
	];

	protected $fillable = [
		'title',
		'description',
		'course_id'
	];

	public function course()
	{
		return $this->belongsTo(Course::class);
	}

	public function module_files()
	{
		return $this->hasMany(ModuleFile::class, 'modules_id');
	}

	public function module_videos()
	{
		return $this->hasMany(ModuleVideo::class, 'modules_id');
	}
}
