<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CmsMenusPrivilege
 * 
 * @property int $id
 * @property int|null $id_cms_menus
 * @property int|null $id_cms_privileges
 *
 * @package App\Models
 */
class CmsMenusPrivilege extends Model
{
	protected $table = 'cms_menus_privileges';
	public $timestamps = false;

	protected $casts = [
		'id_cms_menus' => 'int',
		'id_cms_privileges' => 'int'
	];

	protected $fillable = [
		'id_cms_menus',
		'id_cms_privileges'
	];
}
