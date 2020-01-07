<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class DeactivateUsers extends Command {
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'users:deactivate';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Deactivate users';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct() {
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle() {
		$now = Carbon::now();
		$now = $now->addDay( 1 );
		$now = $now->subYear( 1 );
		DB::table( 'cms_users' )
		  ->where( 'activated_at', '<=', $now )
		  ->update( [
			  'estado' => null
		  ] );

	}
}
