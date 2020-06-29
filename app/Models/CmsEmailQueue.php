<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CmsEmailQueue
 * 
 * @property int $id
 * @property Carbon|null $send_at
 * @property string|null $email_recipient
 * @property string|null $email_from_email
 * @property string|null $email_from_name
 * @property string|null $email_cc_email
 * @property string|null $email_subject
 * @property string|null $email_content
 * @property string|null $email_attachments
 * @property bool|null $is_sent
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class CmsEmailQueue extends Model
{
	protected $table = 'cms_email_queues';

	protected $casts = [
		'is_sent' => 'bool'
	];

	protected $dates = [
		'send_at'
	];

	protected $fillable = [
		'send_at',
		'email_recipient',
		'email_from_email',
		'email_from_name',
		'email_cc_email',
		'email_subject',
		'email_content',
		'email_attachments',
		'is_sent'
	];
}
