<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CourseCategory
 * 
 * @property int $id
 * @property string|null $nombre
 * @property string|null $logo
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Course[] $courses
 *
 * @package App\Models
 */
class CourseCategory extends Model
{
	protected $table = 'course_categories';

	protected $fillable = [
		'nombre',
		'logo'
	];

	public function courses()
	{
		return $this->hasMany(Course::class);
	}
}
