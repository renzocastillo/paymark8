<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CmsPrivilege
 * 
 * @property int $id
 * @property string|null $name
 * @property bool|null $is_superadmin
 * @property string|null $theme_color
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class CmsPrivilege extends Model
{
	protected $table = 'cms_privileges';

	protected $casts = [
		'is_superadmin' => 'bool'
	];

	protected $fillable = [
		'name',
		'is_superadmin',
		'theme_color'
	];
}
