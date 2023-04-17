<?php

use Illuminate\Support\Facades\Route;
use PHPUnit\TextUI\XmlConfiguration\Group;

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


Route::middleware('session-check')->group(function () {
    Route::get('/', function () {
        return view('User.login');
    });
    Route::view('signup','User.signup');

});

Route::post('users_login','App\Http\Controllers\WebController\UserController@login')->name('users_login');
Route::post('users_signup','App\Http\Controllers\WebController\UserController@signup')->name('users_signup');

Route::middleware('login-check')->group(function () {
    Route::view('home','home');
    // Route::get('user_update/{id}','App\Http\Controllers\WebController\UserController@update_data');

Route::get('user_data','App\Http\Controllers\WebController\UserController@data')->name('users_data');
Route::put('/users_update/{id}', [UserController::class, 'update'])->name('users_update');
// Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');

Route::get('user_delete/{id}','App\Http\Controllers\WebController\UserController@delete')->name('users_delete');
Route::get('user_logout','App\Http\Controllers\WebController\UserController@logout')->name('users_logout');
});
                                            // User CRUD completed


                                            // Vendor CRUD starts
Route::post('vendor_signup','App\Http\Controllers\WebController\vendorController@signup')->name('vendors_signup');
Route::post('vendor_login','App\Http\Controllers\WebController\vendorController@login')->name('vendors_login');
// Vendor login signup
Route::put('vendor_update/{id}','App\Http\Controllers\WebController\vendorController@update')->name('vendors_update');
Route::delete('vendor_delete/{id}','App\Http\Controllers\WebController\vendorController@delete')->name('vendors_delete');
Route::get('vendor_data','App\Http\Controllers\WebController\vendorController@data')->name('vendors_data');
// vendor CRUD completed
