<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Country
 * 
 * @property int $id
 * @property string $iso
 * @property string $name
 * @property string $nicename
 * @property string|null $iso3
 * @property int|null $numcode
 * @property int $phonecode
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|CmsUser[] $cms_users
 *
 * @package App\Models
 */
class Country extends Model
{
	protected $table = 'countries';

	protected $casts = [
		'numcode' => 'int',
		'phonecode' => 'int'
	];

	protected $fillable = [
		'iso',
		'name',
		'nicename',
		'iso3',
		'numcode',
		'phonecode'
	];

	public function cms_users()
	{
		return $this->hasMany(CmsUser::class);
	}
}
