<?php

namespace App\Http\Controllers;

use App\Notifications\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class ContactController extends Controller {

	public function index(){
		return redirect( '/admin/contacto' );
	}

	public function create(Request $request ) {
		$input = $request->all();
		Notification::route( 'mail', env( 'MAIL_CONTACTO_TO' ) )
		            ->notify( new Contact( $input['subject'], $input['message'] ) );

		return redirect( '/admin/contacto' );
	}
}
