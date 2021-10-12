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

// Route::get('/', function () {
//     return view('web.template');
// });
Route::get('/', 'App\Http\Controllers\WebController@index')->name('web');

Route::get('/login', 'App\Http\Controllers\User\LoginController@index')->name('login');
// Route::post('/cek', 'App\Http\Controllers\User\LoginController@cek')->name('cek');


Route::group(['prefix' => 'admin'], function () {
    Route::get('/dashboard', 'App\Http\Controllers\Admin\DashboardController@index')->name('admin.dashboard');
});
Route::group(['prefix' => 'admin/profil'], function () {
    Route::get('/', 'App\Http\Controllers\Admin\ProfileController@index')->name('admin.profile');
    Route::get('/tambah-data', 'App\Http\Controllers\Admin\ProfileController@create')->name('admin.profile.create');
    Route::post('/', 'App\Http\Controllers\Admin\ProfileController@store')->name('admin.profile.store');
    Route::get('/edit/{id}', 'App\Http\Controllers\Admin\ProfileController@edit')->name('admin.profile.edit');
    Route::get('/{id}/hapus', 'App\Http\Controllers\Admin\ProfileController@destroy')->name('admin.profile.destroy');
    Route::post('/upload', 'App\Http\Controllers\Admin\ProfileController@upload')->name('upload');
});
Route::group(['prefix' => 'admin/post'], function () {
    Route::get('/', 'App\Http\Controllers\Admin\PostController@index')->name('admin.post');
    Route::get('/tambah-data', 'App\Http\Admin\Controllers\PostController@create')->name('admin.post.create');
    Route::post('/', 'App\Http\Controllers\Admin\PostController@store')->name('admin.post.store');
    Route::get('/edit/{id}', 'App\Http\Controllers\Admin\PostController@edit')->name('admin.post.edit');
    Route::get('/{id}/hapus', 'App\Http\Controllers\Admin\PostController@destroy')->name('admin.post.destroy');
});

Route::get('/profil/{slug}', 'App\Http\Controllers\WebController@profil')->name('web.profile.show');
Route::get('/post/{slug}', 'App\Http\Controllers\WebController@post')->name('web.post.show');
Route::get('/psikoedukasi/{slug}', 'App\Http\Controllers\WebController@post')->name('web.psikoedukasi.show');

Route::group(['middleware' => ['web','auth'],'prefix' => 'user'],function(){
    Route::post('/start-sesi', 'App\Http\Controllers\User\AssesmentController@startSesi')->name('assesment.start');
    Route::get('/asesmen-info', 'App\Http\Controllers\User\AssesmentController@info')->name('assesment.info');
    Route::get('/asesmen/sesi/{id}', 'App\Http\Controllers\User\AssesmentController@form')->name('assesment.form');
    Route::get('/asesmen/sesi/hasil/{id}', 'App\Http\Controllers\User\AssesmentController@getScore')->name('assesment.score');
    Route::post('/lanjut/{id}', 'App\Http\Controllers\User\AssesmentController@next')->name('assesment.next');

    // Route::get('/login', 'App\Http\Controllers\User\LoginController@index')->name('user.login');
    Route::get('/dashboard', 'App\Http\Controllers\User\DashboardController@index')->name('user.dashboard');
});


Route::group(['prefix' => 'admin/konselor'], function () {
    Route::get('/', 'App\Http\Controllers\Admin\KonselorController@index')->name('admin.konselor');
    Route::get('/tambah-data', 'App\Http\Controllers\Admin\KonselorController@create')->name('admin.konselor.create');
    Route::post('/simpan', 'App\Http\Controllers\Admin\KonselorController@store')->name('admin.konselor.store');
    
});
Route::group(['middleware' => ['web','auth'],'prefix' => 'konselor'],function(){
    Route::group(['prefix' => 'konseling'], function () {
        Route::get('/', 'App\Http\Controllers\Konselor\KonselingJadwalController@index')->name('konseling.data');
        Route::get('/atur-jadwal/{konselingSesiId}', 'App\Http\Controllers\Konselor\KonselingJadwalController@setSchedule')->name('konseling.set');
    });
    Route::get('/dashboard', 'App\Http\Controllers\Konselor\DashboardController@index')->name('konselor.dashboard');
});
Route::group(['prefix' => 'admin/konseling'], function () {
    Route::get('/jadwal-tunggu', 'App\Http\Controllers\Admin\KonselingSesiController@index')->name('admin.conseling.wait');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');