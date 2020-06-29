<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CmsStatisticComponent
 * 
 * @property int $id
 * @property int|null $id_cms_statistics
 * @property string|null $componentID
 * @property string|null $component_name
 * @property string|null $area_name
 * @property int|null $sorting
 * @property string|null $name
 * @property string|null $config
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class CmsStatisticComponent extends Model
{
	protected $table = 'cms_statistic_components';

	protected $casts = [
		'id_cms_statistics' => 'int',
		'sorting' => 'int'
	];

	protected $fillable = [
		'id_cms_statistics',
		'componentID',
		'component_name',
		'area_name',
		'sorting',
		'name',
		'config'
	];
}
