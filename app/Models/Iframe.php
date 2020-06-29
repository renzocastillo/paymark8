<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Iframe
 * 
 * @property int $id
 * @property string|null $title
 * @property string|null $html
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Iframe extends Model
{
	protected $table = 'iframes';

	protected $fillable = [
		'title',
		'html'
	];
}
