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
//     return view('index');
// });

Route::group([
    'middleware' => 'guest'
], function ($router){
    Route::get('/','App\Http\Controllers\DashboardController@login')->name('index.login');
    Route::get('/register','App\Http\Controllers\DashboardController@register')->name('index.register');
    Route::post('/post_register','App\Http\Controllers\DashboardController@post_register')->name('index.post.register');
    Route::post('/post_login','App\Http\Controllers\DashboardController@post_login')->name('index.post.login');
});

Route::group([
    'middleware' => 'admin'
], function ($router){
    Route::get('/logout', 'App\Http\Controllers\DashboardController@logout')->name('logout');
    Route::get('/dashboard','App\Http\Controllers\DashboardController@pegawai')->name('index.pegawai');
    Route::post('/tambah_pegawai','App\Http\Controllers\DashboardController@tambah_pegawai')->name('tambah.pegawai');
    Route::post('/edit_pegawai/{id}','App\Http\Controllers\DashboardController@edit_pegawai')->name('edit.pegawai');
    Route::get('/hapus_pegawai/{id}','App\Http\Controllers\DashboardController@hapus')->name('hapus.pegawai');
    Route::get('search_pegawai', 'DashboardController@search');
});
