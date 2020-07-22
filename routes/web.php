<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/terminos-y-condiciones',function(){
   return view('terminos');
});
Route::get('/', 'WelcomeController@getview')->name('welcome');
Route::get('/check_email', 'AdminCmsUsersController@checkEmail')->name('check_email');
Route::post('/registrarme', 'AdminCmsUsersController@registerUser')->name('register');
if(!Request::is('admin/*')) {
   Route::get('/{user}', 'WelcomeController@getview')->name('welcome');
   Route::post('/{user}/add_reprod', 'WelcomeController@addReproduccion')->name('add-reproduccion');
}
Route::get('/admin/configuraciones/save-setting','AdminCmsSettingsController@postSaveSetting')->name('save-setting');
Route::get('/admin/configuraciones/delete-file-setting','AdminCmsSettingsController@getDeleteFileSetting')->name('delete-file-setting');
Route::get('/admin/users/change_user_estado/{id}','AdminCmsUsersController@changeUserEstado')->name('change-user-estado');
Route::get('/admin/users/change_solicitud_estado/{id}','AdminCmsUsersController@changeSolicitudEstado')->name('change-solicitud-estado');
Route::get('/admin/users/change_premium_estado/{id}','AdminCmsUsersController@changePremiumEstado')->name('change-premium-estado');
Route::post('/admin/contacto','AdminContactoController@create');
Route::post('visanet/checkout', 'VisanetController@checkout');
Route::get('visanet/timeout', 'VisanetController@timeout');
Route::get('visanet/transaction/{transactionId}/print', 'VisanetController@print');
Route::get('/admin/courses/content/{$id}','AdminCoursesController@getContent');