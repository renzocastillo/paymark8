<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CmsStatistic
 * 
 * @property int $id
 * @property string|null $name
 * @property string|null $slug
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class CmsStatistic extends Model
{
	protected $table = 'cms_statistics';

	protected $fillable = [
		'name',
		'slug'
	];
}
