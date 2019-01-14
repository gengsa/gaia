<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', 'IndexController@index')->name('index');

// Authentication Routes...
Route::get('/account/login', 'Auth\LoginController@showLoginForm')->name('account.login');
Route::post('/account/login', 'Auth\LoginController@login');
Route::get('/account/logout', 'Auth\LoginController@logout')->name('account.logout');

// Registration Routes...
Route::get('/account/register', 'Auth\RegisterController@showRegistrationForm')->name('account.register');
Route::post('/account/register', 'Auth\RegisterController@register');

// Password Reset Routes...
// $this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
// $this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
// $this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
// $this->post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

// Email Verification Routes...
// $this->get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
// $this->get('email/verify/{id}', 'Auth\VerificationController@verify')->name('verification.verify');
// $this->get('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');
