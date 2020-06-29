<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Estado
 * 
 * @property int $id
 * @property string|null $nombre
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|SolicitudesDePago[] $solicitudes_de_pagos
 *
 * @package App\Models
 */
class Estado extends Model
{
	protected $table = 'estados';

	protected $fillable = [
		'nombre'
	];

	public function solicitudes_de_pagos()
	{
		return $this->hasMany(SolicitudesDePago::class, 'estados_id');
	}
}
