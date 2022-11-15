<?php
  use App\Http\Controllers\LanguageController;

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
    // Route Dashboards

Route::get('/', 'DashboardController@home');
Route::get('/deposit-page', 'DashboardController@depositPage');
Route::get('/withdraw-page', 'DashboardController@home');
Route::get('/deposit_address/{network}/{id}', 'DashboardController@getDepositAddress');



Route::post('/login', 'DashboardController@login');

// Route Authentication Pages
Route::get('/login', 'AuthenticationController@login');
Route::get('/auth-login', 'AuthenticationController@login');
Route::get('/auth-register', 'AuthenticationController@register');
Route::get('/auth-forgot-password', 'AuthenticationController@forgot_password');
Route::get('/auth-reset-password', 'AuthenticationController@reset_password');
Route::get('/auth-lock-screen', 'AuthenticationController@lock_screen');

// Auth::routes();

// Route url
Route::middleware([])->group(function () {
   
    Route::post('/upload/csvFile', 'DashboardController@upload');

    // Route Components
    Route::get('/sk-layout-2-columns', 'StaterkitController@columns_2');
    Route::get('/sk-layout-fixed-navbar', 'StaterkitController@fixed_navbar');
    Route::get('/sk-layout-floating-navbar', 'StaterkitController@floating_navbar');
    Route::get('/sk-layout-fixed', 'StaterkitController@fixed_layout');

    // acess controller
    Route::get('/access-control', 'AccessController@index');
    Route::get('/access-control/{roles}', 'AccessController@roles');
    Route::get('/modern-admin', 'AccessController@home')->middleware('permissions:approve-post');
    // locale Route
    Route::get('lang/{locale}',[LanguageController::class,'swap']);
});