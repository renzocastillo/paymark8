<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CourseGallery
 * 
 * @property int $id
 * @property string $url
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $course_id
 * 
 * @property Course $course
 *
 * @package App\Models
 */
class CourseGallery extends Model
{
	protected $table = 'course_galleries';

	protected $casts = [
		'course_id' => 'int'
	];

	protected $fillable = [
		'url',
		'course_id'
	];

	public function course()
	{
		return $this->belongsTo(Course::class);
	}
}
