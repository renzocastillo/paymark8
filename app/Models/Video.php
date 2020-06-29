<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Video
 * 
 * @property int $id
 * @property string|null $url
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Reproduccione[] $reproducciones
 *
 * @package App\Models
 */
class Video extends Model
{
	protected $table = 'videos';

	protected $fillable = [
		'url'
	];

	public function reproducciones()
	{
		return $this->hasMany(Reproduccione::class, 'videos_id');
	}
}
