<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CmsMenu
 * 
 * @property int $id
 * @property string|null $name
 * @property string $type
 * @property string|null $path
 * @property string|null $color
 * @property string|null $icon
 * @property int|null $parent_id
 * @property bool $is_active
 * @property bool $is_dashboard
 * @property int|null $id_cms_privileges
 * @property int|null $sorting
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class CmsMenu extends Model
{
	protected $table = 'cms_menus';

	protected $casts = [
		'parent_id' => 'int',
		'is_active' => 'bool',
		'is_dashboard' => 'bool',
		'id_cms_privileges' => 'int',
		'sorting' => 'int'
	];

	protected $fillable = [
		'name',
		'type',
		'path',
		'color',
		'icon',
		'parent_id',
		'is_active',
		'is_dashboard',
		'id_cms_privileges',
		'sorting'
	];
}
