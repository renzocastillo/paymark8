<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CmsPrivilegesRole
 * 
 * @property int $id
 * @property bool|null $is_visible
 * @property bool|null $is_create
 * @property bool|null $is_read
 * @property bool|null $is_edit
 * @property bool|null $is_delete
 * @property int|null $id_cms_privileges
 * @property int|null $id_cms_moduls
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class CmsPrivilegesRole extends Model
{
	protected $table = 'cms_privileges_roles';

	protected $casts = [
		'is_visible' => 'bool',
		'is_create' => 'bool',
		'is_read' => 'bool',
		'is_edit' => 'bool',
		'is_delete' => 'bool',
		'id_cms_privileges' => 'int',
		'id_cms_moduls' => 'int'
	];

	protected $fillable = [
		'is_visible',
		'is_create',
		'is_read',
		'is_edit',
		'is_delete',
		'id_cms_privileges',
		'id_cms_moduls'
	];
}
