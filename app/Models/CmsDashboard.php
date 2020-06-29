<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CmsDashboard
 * 
 * @property int $id
 * @property string|null $name
 * @property int|null $id_cms_privileges
 * @property string|null $content
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class CmsDashboard extends Model
{
	protected $table = 'cms_dashboard';

	protected $casts = [
		'id_cms_privileges' => 'int'
	];

	protected $fillable = [
		'name',
		'id_cms_privileges',
		'content'
	];
}
