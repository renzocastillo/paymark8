<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class CmsModul
 * 
 * @property int $id
 * @property string|null $name
 * @property string|null $icon
 * @property string|null $path
 * @property string|null $table_name
 * @property string|null $controller
 * @property bool $is_protected
 * @property bool $is_active
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @package App\Models
 */
class CmsModul extends Model
{
	use SoftDeletes;
	protected $table = 'cms_moduls';

	protected $casts = [
		'is_protected' => 'bool',
		'is_active' => 'bool'
	];

	protected $fillable = [
		'name',
		'icon',
		'path',
		'table_name',
		'controller',
		'is_protected',
		'is_active'
	];
}
