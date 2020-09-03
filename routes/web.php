<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
// User Profile
Route::get('user/profile', 'UserController@profile')->name('user.view');
Route::post('user/profile/create', 'UserController@profilestore')->name('profile.create');
Route::post('user/coverletter', 'UserController@coverletter')->name('cover.letter');
Route::post('user/identification', 'UserController@identification')->name('identification');
Route::post('user/avatar', 'UserController@avatar')->name('avatar');
Route::post('close', 'UserController@close')->name('close');
