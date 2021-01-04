<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CmsUserCourse
 * 
 * @property int $cms_user_id
 * @property int $course_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property CmsUser $cms_user
 * @property Course $course
 *
 * @package App\Models
 */
class CmsUserCourse extends Model
{
	protected $table = 'cms_user_course';
	public $incrementing = false;
	protected $fillable = [
		'cms_user_id',
		'course_id'
	];
	protected $casts = [
		'cms_user_id' => 'int',
		'course_id' => 'int'
	];

	public function cms_user()
	{
		return $this->belongsTo(CmsUser::class);
	}

	public function course()
	{
		return $this->belongsTo(Course::class);
	}
}
