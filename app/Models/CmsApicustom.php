<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CmsApicustom
 * 
 * @property int $id
 * @property string|null $permalink
 * @property string|null $tabel
 * @property string|null $aksi
 * @property string|null $kolom
 * @property string|null $orderby
 * @property string|null $sub_query_1
 * @property string|null $sql_where
 * @property string|null $nama
 * @property string|null $keterangan
 * @property string|null $parameter
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $method_type
 * @property string|null $parameters
 * @property string|null $responses
 *
 * @package App\Models
 */
class CmsApicustom extends Model
{
	protected $table = 'cms_apicustom';

	protected $fillable = [
		'permalink',
		'tabel',
		'aksi',
		'kolom',
		'orderby',
		'sub_query_1',
		'sql_where',
		'nama',
		'keterangan',
		'parameter',
		'method_type',
		'parameters',
		'responses'
	];
}
