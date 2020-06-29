<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CmsUser
 * 
 * @property int $id
 * @property string|null $name
 * @property string|null $photo
 * @property string|null $email
 * @property string|null $password
 * @property int|null $id_cms_privileges
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $status
 * @property Carbon|null $activated_at
 * @property string|null $email_paypal
 * @property bool|null $estado
 * @property int|null $vistas_actuales
 * @property int|null $afiliaciones_actuales
 * @property int|null $nietos_actuales
 * @property string|null $whatsapp
 * @property string|null $slug
 * @property bool $premium
 * @property int|null $cms_users_id
 * @property int|null $country_id
 * 
 * @property CmsUser $cms_user
 * @property Country $country
 * @property Collection|Course[] $courses
 * @property Collection|CmsUser[] $cms_users
 * @property Collection|Purchase[] $purchases
 * @property Collection|Reproduccione[] $reproducciones
 * @property Collection|SolicitudesDePago[] $solicitudes_de_pagos
 *
 * @package App\Models
 */
class CmsUser extends Model
{
	protected $table = 'cms_users';

	protected $casts = [
		'id_cms_privileges' => 'int',
		'estado' => 'bool',
		'vistas_actuales' => 'int',
		'afiliaciones_actuales' => 'int',
		'nietos_actuales' => 'int',
		'premium' => 'bool',
		'cms_users_id' => 'int',
		'country_id' => 'int'
	];

	protected $dates = [
		'activated_at'
	];

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'name',
		'photo',
		'email',
		'password',
		'id_cms_privileges',
		'status',
		'activated_at',
		'email_paypal',
		'estado',
		'vistas_actuales',
		'afiliaciones_actuales',
		'nietos_actuales',
		'whatsapp',
		'slug',
		'premium',
		'cms_users_id',
		'country_id'
	];

	public function cms_user()
	{
		return $this->belongsTo(CmsUser::class, 'cms_users_id');
	}

	public function country()
	{
		return $this->belongsTo(Country::class);
	}

	public function courses()
	{
		return $this->belongsToMany(Course::class)
					->withTimestamps();
	}

	public function cms_users()
	{
		return $this->hasMany(CmsUser::class, 'cms_users_id');
	}

	public function purchases()
	{
		return $this->hasMany(Purchase::class, 'user_id');
	}

	public function reproducciones()
	{
		return $this->hasMany(Reproduccione::class, 'cms_users_id');
	}

	public function solicitudes_de_pagos()
	{
		return $this->hasMany(SolicitudesDePago::class, 'cms_users_id');
	}
}
