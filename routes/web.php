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
Route::resource( '/user' , 'UserController' );
Route::get('/user/hapus/{kode}','UserController@destroy');
Route::resource( '/akun' , 'AkunController' );
Route::get('/akun/hapus/{kode}','AkunController@destroy');
Route::resource( '/kaskeluar', 'KasKeluarController');
Route::get('/kaskeluar/hapus/{id}','KasKeluarController@destroy');
Route::resource( '/bukubesar' , 'BukubesarController' );
Route::resource( '/kasmasuk', 'KasMasukController');
Route::get('/kasmasuk/hapus/{id}','KasMasukController@destroy');
Route::resource('/laporan','LaporanController');
Route::resource( '/jawi', 'JawiController');
Route::resource( '/kustin', 'KustinController');
Route::resource( '/limpapeh', 'LimpapehController');
Route::resource( '/bodo', 'BodoController');
Route::resource( '/kurung', 'KurungController');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
