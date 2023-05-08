<?php

use App\Http\Controllers\PasswordResetController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use PHPUnit\TextUI\XmlConfiguration\Group;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
                                            // User Auth starts
Route::post('reset',[PasswordResetController::class,'send_reset_password_email'])->name('reset');

Route::post('/reset-password/{token}', [PasswordResetController::class, 'reset']);
Route::view('/reset-pass/{token}','Email.');


Route::post('user_login','App\Http\Controllers\APIController\UserController@login')->name('user_login');
Route::post('user_signup','App\Http\Controllers\APIController\UserController@signup')->name('user_signup');
                                            // User Auth Ends

Route::middleware(['auth:sanctum'])->group(function () {
                                            // User CRUD starts

Route::put('user_update/{id}','App\Http\Controllers\APIController\UserController@update')->name('user_update');
Route::delete('user_delete/{id}','App\Http\Controllers\APIController\UserController@delete')->name('user_delete');
Route::get('user_data','App\Http\Controllers\APIController\UserController@data')->name('user_data');
Route::post('user_logout','App\Http\Controllers\APIController\UserController@logout')->name('user_logout');
                                            // User CRUD completed
                                            // organization CRUD starts
Route::post('organization_signup','App\Http\Controllers\APIController\organizationController@signup')->name('organization_signup');
Route::post('organization_login','App\Http\Controllers\APIController\organizationController@login')->name('organization_login');
                                            // organization Controls
Route::put('organization_update/{id}','App\Http\Controllers\APIController\organizationController@update')->name('organization_update');
Route::delete('organization_delete/{id}','App\Http\Controllers\APIController\organizationController@delete')->name('organization_delete');
Route::get('organization_data','App\Http\Controllers\APIController\organizationController@data')->name('organization_data');
                                            // organization CRUD completed
                                            // Item Controls
Route::post('add_item','App\Http\Controllers\APIController\ItemController@add_item')->name('add_item');
Route::get('delete_item/{id}','App\Http\Controllers\APIController\ItemController@delete_item')->name('delete_item');
Route::post('update_item/{id}','App\Http\Controllers\APIController\ItemController@update_item')->name('update_item');
Route::get('show_item','App\Http\Controllers\APIController\ItemController@show_item')->name('show_item');

});
