<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SolicitudesDePago
 * 
 * @property int $id
 * @property int|null $monto
 * @property int|null $vistas
 * @property int|null $afiliados
 * @property int|null $nietos
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $cms_users_id
 * @property int $estados_id
 * 
 * @property CmsUser $cms_user
 * @property Estado $estado
 *
 * @package App\Models
 */
class SolicitudesDePago extends Model
{
	protected $table = 'solicitudes_de_pago';

	protected $casts = [
		'monto' => 'int',
		'vistas' => 'int',
		'afiliados' => 'int',
		'nietos' => 'int',
		'cms_users_id' => 'int',
		'estados_id' => 'int'
	];

	protected $fillable = [
		'monto',
		'vistas',
		'afiliados',
		'nietos',
		'cms_users_id',
		'estados_id'
	];

	public function cms_user()
	{
		return $this->belongsTo(CmsUser::class, 'cms_users_id');
	}

	public function estado()
	{
		return $this->belongsTo(Estado::class, 'estados_id');
	}
}
