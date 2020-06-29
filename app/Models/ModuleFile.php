<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ModuleFile
 * 
 * @property int $id
 * @property string $url
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $modules_id
 * 
 * @property Module $module
 *
 * @package App\Models
 */
class ModuleFile extends Model
{
	protected $table = 'module_files';

	protected $casts = [
		'modules_id' => 'int'
	];

	protected $fillable = [
		'url',
		'modules_id'
	];

	public function module()
	{
		return $this->belongsTo(Module::class, 'modules_id');
	}
}
