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
Route::get('/', 'WelcomeController@getview')->name('welcome');
//Route::get('/', function () {
   // return view('welcome');
//});
Route::get('/admin/configuraciones/save-setting','AdminCmsSettingsController@postSaveSetting')->name('save-setting');
Route::get('/admin/configuraciones/delete-file-setting','AdminCmsSettingsController@getDeleteFileSetting')->name('delete-file-setting');
