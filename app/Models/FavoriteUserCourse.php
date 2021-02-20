<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FavoriteUserCourse extends Model
{
    
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
