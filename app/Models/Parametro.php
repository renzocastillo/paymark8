<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Parametro
 * 
 * @property int $id
 * @property string|null $name
 * @property string|null $content
 * @property string|null $helper
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $label
 * @property string|null $content_input_type
 *
 * @package App\Models
 */
class Parametro extends Model
{
	protected $table = 'parametros';

	protected $fillable = [
		'name',
		'content',
		'helper',
		'label',
		'content_input_type'
	];
}
