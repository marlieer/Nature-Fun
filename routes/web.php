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

Route::get('/', 'PagesController@welcome');
Route::get('/home','HomeController@index');

Route::post('/family2', 'FamilyController@store2');
Route::get('/family/create2','FamilyController@create2');

Route::resource('session','SessionController');
Route::resource('registration','RegistrationController');
Route::resource('child','ChildController');
Route::resource('family','FamilyController');

Route::get('/registration/{session}/create','RegistrationController@create');

Auth::routes();