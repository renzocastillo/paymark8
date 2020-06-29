<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CmsSetting
 * 
 * @property int $id
 * @property string|null $name
 * @property string|null $content
 * @property string|null $content_input_type
 * @property string|null $dataenum
 * @property string|null $helper
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $group_setting
 * @property string|null $label
 *
 * @package App\Models
 */
class CmsSetting extends Model
{
	protected $table = 'cms_settings';

	protected $fillable = [
		'name',
		'content',
		'content_input_type',
		'dataenum',
		'helper',
		'group_setting',
		'label'
	];
}
