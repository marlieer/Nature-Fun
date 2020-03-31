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

use Illuminate\Support\Facades\Auth;

Route::get('/', 'PagesController@welcome');
Route::get('/home','HomeController@index');
Route::get('/contact_us', function() {
	return view('contact_us');
});

Route::resource('session','SessionController');
Route::resource('registration','RegistrationController');
Route::resource('child','ChildController');
Route::resource('family','FamilyController');

Route::get('/session/showbydate/{date}', 'SessionController@showbydate');

Route::get('/registration/{session}/create','RegistrationController@create');
Route::post('/registrationAsAdmin','RegistrationController@storeAsAdmin');
Route::post('/manualRegistration','RegistrationController@storeManual');


Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('register', 'FamilyController@create')->name('register');
Route::post('register', 'Auth\RegisterController@register');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
