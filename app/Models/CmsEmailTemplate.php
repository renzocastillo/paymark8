<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CmsEmailTemplate
 * 
 * @property int $id
 * @property string|null $name
 * @property string|null $slug
 * @property string|null $subject
 * @property string|null $content
 * @property string|null $description
 * @property string|null $from_name
 * @property string|null $from_email
 * @property string|null $cc_email
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class CmsEmailTemplate extends Model
{
	protected $table = 'cms_email_templates';

	protected $fillable = [
		'name',
		'slug',
		'subject',
		'content',
		'description',
		'from_name',
		'from_email',
		'cc_email'
	];
}
