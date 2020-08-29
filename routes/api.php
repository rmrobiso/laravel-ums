<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
 
Route::middleware('auth:api', 'admin.only')->group(function () {
    // List All Users
    Route::get('users', 'UserController@index');

    // List Single User
    Route::get('user/{id}', 'UserController@show');

    // Create new User
    Route::post('user/', 'UserController@store');

    // Update Single User
    Route::put('user/', 'UserController@store');

    // Delete a User by ID
    Route::delete('user/{id}', 'UserController@destroy');

    // Delete multiple UserS
    Route::post('users/delete-multiple', 'UserController@deleteMultiple');
});

Route::post('register', 'PassportController@register');
Route::post('login', 'PassportController@login');
Route::get('logout', 'PassportController@logout')->middleware('auth:api');