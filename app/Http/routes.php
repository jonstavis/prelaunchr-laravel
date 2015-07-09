<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::controller('auth', 'Auth\AuthController', [
	'getConfirm' => 'auth.confirm',
	'getResendConfirm' => 'auth.confirm.resend'
]);

Route::controller('password', 'Auth\PasswordController');

Route::get('/status/{referral_secret?}', [ 'as' => 'user.status', 'uses' => 'UsersController@status' ]);

Route::get('/privacy', [ 'as' => 'privacy', function() {
	return view('static.privacy');
}]);

Route::get('/', [ 'as' => 'user.create', 'middleware' => 'status-page', 'uses' => 'UsersController@create' ]);
Route::get('/homepage', [ 'as' => 'user.create.nostatus', 'uses' => 'UsersController@create' ]);
Route::post('/', [ 'as' => 'user.store', 'uses' => 'UsersController@store' ]);
Route::get('/{referrer_code}', [ 'as' => 'user.referral', 'uses' => 'UsersController@referral' ]);
