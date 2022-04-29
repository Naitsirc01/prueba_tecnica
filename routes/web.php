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

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

Route::get('/archivo', 'App\Http\Controllers\ArchivoController@index');
Route::get('/archivo/{user_id}', 'App\Http\Controllers\ArchivoController@index');
Route::get('/historial', 'App\Http\Controllers\ArchivoController@historial_archivo');
Route::get('/historial_archivo_admin', 'App\Http\Controllers\ArchivoController@historial_archivo_admin');
Route::post('/upload_file', 'App\Http\Controllers\ArchivoController@upload_file');
Route::post('/upload_file/{user_id}', 'App\Http\Controllers\ArchivoController@upload_file');
Route::get('/delete_file/{id}', 'App\Http\Controllers\ArchivoController@destroy_file');
Route::get('/delete_file/{id}/{admin}', 'App\Http\Controllers\ArchivoController@destroy_file');
Route::get('/download_file/{id}', 'App\Http\Controllers\ArchivoController@download_file');
Route::get('/download_all', 'App\Http\Controllers\ArchivoController@download_file_all');


Route::get('/usuarios', 'App\Http\Controllers\UserController@index');
