<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group(['prefix' => 'profil'], function () {
    Route::get('/{id}/', 'App\Http\Controllers\ProfileController@index')->name('ggwp');
    Route::post('/', 'App\Http\Controllers\ProfileController@store');
});

Route::group(['prefix' => 'assesment'], function () {
    Route::get('/soal/{id}', 'App\Http\Controllers\User\AssesmentController@show')->name('assesment.get.soal');
    Route::get('/terjawab/{sessionId}', 'App\Http\Controllers\User\AssesmentController@getAnswered')->name('assesment.get.jawab');
    Route::post('/simpan', 'App\Http\Controllers\User\AssesmentController@store')->name('assesment.save');
});

Route::group(['prefix' => 'konseling'], function () {
    Route::post('/simpan', 'App\Http\Controllers\Admin\KonselingSesiController@store')->name('konseling.save');
    Route::post('/save', 'App\Http\Controllers\Konselor\KonselingJadwalController@store')->name('konseling.store');
    Route::get('/delete/{id}', 'App\Http\Controllers\Konselor\KonselingJadwalController@destroy')->name('konseling.delete');

});


// Route::group([

//     'middleware' => 'api',
//     'prefix' => 'auth'

// ], function ($router) {

//     Route::post('login', 'App\Http\Controllers\AuthController@login');
//     Route::post('logout', 'AuthController@logout');
//     Route::post('refresh', 'AuthController@refresh');
//     Route::get('me', 'App\Http\Controllers\AuthController@me');
//     Route::get('gg', 'App\Http\Controllers\User\LoginController@index')->name('user.login');

// });