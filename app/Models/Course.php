<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Course
 * 
 * @property int $id
 * @property string $title
 * @property string $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string $author
 * @property float $price
 * @property int $duration
 * @property int $course_category_id
 * 
 * @property CourseCategory $course_category
 * @property Collection|CmsUser[] $cms_users
 * @property Collection|CourseGallery[] $course_galleries
 * @property Collection|Module[] $modules
 *
 * @package App\Models
 */
class Course extends Model
{
	protected $table = 'courses';

	protected $casts = [
		'price' => 'float',
		'duration' => 'int',
		'course_category_id' => 'int'
	];

	protected $fillable = [
		'title',
		'description',
		'author',
		'price',
		'duration',
		'course_category_id'
	];

	public function course_category()
	{
		return $this->belongsTo(CourseCategory::class);
	}

	public function cms_users()
	{
		return $this->belongsToMany(CmsUser::class)
					->withTimestamps();
	}

	public function course_galleries()
	{
		return $this->hasMany(CourseGallery::class);
	}

	public function modules()
	{
		return $this->hasMany(Module::class);
	}
}
