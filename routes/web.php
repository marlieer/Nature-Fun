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


// routes that do not require login
Route::get('/', 'PagesController@welcome')->name('welcome');
Route::get('/contact_us', function() {
	return view('contact_us');
})->name('contact_us');


// must be logged in to access these routes
Route::middleware('auth')->group( function() {
    Route::resource('registration','RegistrationController');

    // add a child to your account
    Route::get('/child/create', 'ChildController@create')->name('child.create');
    Route::post('child', 'ChildController@store')->name('child.store');

    // view profile
    Route::get('/profile', 'UserController@profile')->name('profile');

    // go to dashboard
    Route::get('/dashboard','HomeController@dashboard')->name('dashboard');

    // register for a session
    Route::get('/registration/{session}/create','RegistrationController@create');
});


Route::get('/session/showbydate/{date}', 'SessionController@showbydate');

// must be admin to access these routes
Route::middleware(['auth','admin'])->group( function () {

    // get all users
    Route::get('users', 'UserController@index')->name('users.index');

    // get all children
    Route::get('child', 'ChildController@index')->name('child.index');

    // create, edit and delete sessions
    Route::resource('session', 'SessionController')->only([
        'create', 'store', 'edit', 'update', 'destroy'
    ]);

    Route::post('/registrationAsAdmin','RegistrationController@storeAsAdmin');
    Route::post('/manualRegistration','RegistrationController@storeManual');

});


// login and registration
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register')->name('register.store');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');


// view sessions
Route::resource('session', 'SessionController')->only([
    'index', 'show'
]);
