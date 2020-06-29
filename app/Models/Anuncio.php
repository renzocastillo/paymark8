<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Anuncio
 * 
 * @property int $id
 * @property string|null $url
 * @property string|null $imagen
 * @property bool $publico
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Anuncio extends Model
{
	protected $table = 'anuncios';

	protected $casts = [
		'publico' => 'bool'
	];

	protected $fillable = [
		'url',
		'imagen',
		'publico'
	];
}
