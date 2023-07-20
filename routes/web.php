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

Route::get('/index', 'App\Http\Controllers\Controller@index')->name('index')->middleware('auth');
Route::get('/', 'App\Http\Controllers\Controller@index')->name('index')->middleware('auth');
Route::get('/daftar-agenda/{id_agenda}','App\Http\Controllers\Controller@daftar_agenda')->name('daftar-agenda')->middleware('auth');
// Route::get('/test', 'App\Http\Controllers\Controller@index')->name('test');

Route::get('/daganganku', 'App\Http\Controllers\barangController@index')->name('daganganku')->middleware('auth');
Route::get('/nonaktifkan/{id}', 'App\Http\Controllers\barangController@nonaktifkan')->name('nonaktifkan')->middleware('auth');
Route::get('/aktifkan/{id}', 'App\Http\Controllers\barangController@aktifkan')->name('aktifkan')->middleware('auth');
Route::get('/ajukan_kurasi/{id}', 'App\Http\Controllers\barangController@ajukan')->name('ajukan_kurasi')->middleware('auth');
Route::get('/hapus-barang/{id}', 'App\Http\Controllers\barangController@hapus_barang')->name('hapus-barang')->middleware('auth');
Route::get('/tambah-barang','App\Http\Controllers\barangController@tambah_dagangan')->name('tambah-barang')->middleware('auth');
// Route::post('/update-barang/{id}','App\Http\Controllers\barangController@confirm_edit')->name('update-barang')->middleware('auth');
Route::post('/post-barang/{id}','App\Http\Controllers\barangController@post_barang')->name('post-barang')->middleware('auth');
Route::get('/post-kurasiM/{id}','App\Http\Controllers\barangController@post_kurasiMarkethub')->name('post-kurasiMarkethub')->middleware('auth');
Route::get('/edit-dagangan/{id}', 'App\Http\Controllers\barangController@edit_barang')->name('edit-dagangan')->middleware('auth');
Route::get('/edit-diskon/{id}', 'App\Http\Controllers\barangController@edit_diskon')->name('edit-diskon')->middleware('auth');
Route::post('/post-diskon/{id}','App\Http\Controllers\barangController@post_diskon')->name('post-diskon')->middleware('auth');
Route::get('/hapus-diskon/{id}', 'App\Http\Controllers\barangController@hapus_diskon')->name('hapus-diskon')->middleware('auth');


Route::get('/free_ongkir', 'App\Http\Controllers\Controller@ongkir')->name('free_ongkir')->middleware('auth');


Route::get('/registrasi', 'App\Http\Controllers\loginController@registrasi')->name('registrasi')->middleware('guest');
Route::post('/registrasi', 'App\Http\Controllers\loginController@post_registrasi')->name('post_registrasi');
Route::get('/login', 'App\Http\Controllers\loginController@index')->name('login')->middleware('guest');
Route::post('/login', 'App\Http\Controllers\loginController@login')->name('post_login');
Route::get('/reset-pass', 'App\Http\Controllers\loginController@reset_pass')->name('reset-pass')->middleware('auth');
Route::post('/new-pass', 'App\Http\Controllers\loginController@new_pass')->name('new-pass')->middleware('auth');
Route::get('/logout', 'App\Http\Controllers\loginController@logout')->name('logout')->middleware('auth');
Route::post('/getkecamatan', 'App\Http\Controllers\loginController@getKecamatan')->name('getkecamatan');
Route::post('/getkelurahan', 'App\Http\Controllers\loginController@getKelurahan')->name('getkelurahan');
Route::get('/forgot', 'App\Http\Controllers\loginController@forgot')->name('forgot');
Route::post('/forgot', 'App\Http\Controllers\loginController@post_forgot')->name('post_forgot')->middleware('guest');
Route::get('/lupa_password/{token}', 'App\Http\Controllers\loginController@lupa_password')->name('lupa_password')->middleware('guest');
Route::post('/post_lupa/{id}', 'App\Http\Controllers\loginController@post_lupa')->name('post_lupa');


Route::get('/lengkapi-data', 'App\Http\Controllers\dataController@index')->name('lengkapi_data')->middleware('auth');
Route::get('/history_kurasi/{id}', 'App\Http\Controllers\barangController@history_kurasi')->name('history_kurasi')->middleware('auth');
Route::get('/ubah-data/{data}/', 'App\Http\Controllers\dataController@ubah_data')->name('ubah_data')->middleware('auth');
Route::get('/post-data/lokasi/{x}/{y}/{acc}','App\Http\Controllers\dataController@post_location')->name('post_location')->middleware('auth');
Route::get('/hapus-data/lokasi','App\Http\Controllers\dataController@delete_location')->name('delete_location')->middleware('auth');
Route::post('/post-data/omset','App\Http\Controllers\dataController@post_omset')->name('post_omset')->middleware('auth');
Route::get('/hapus-data/omset/{id}','App\Http\Controllers\dataController@delete_omset')->name('delete_omset')->middleware('auth');
Route::get('/stat_omset', 'App\Http\Controllers\dataController@stat_omset')->name('stat_omset')->middleware('auth');
Route::get('/tambah-data/{data}', 'App\Http\Controllers\dataController@tambah_data')->name('tambah_data')->middleware('auth');
Route::get('/hapus-legalitas-usaha/{id}', 'App\Http\Controllers\dataController@hapus_legalitas_usaha')->name('hapus_legalitas_usaha')->middleware('auth');
Route::post('/ubah-data/getkecamatan', 'App\Http\Controllers\dataController@getKecamatan');
Route::post('/ubah-data/getkelurahan', 'App\Http\Controllers\dataController@getKelurahan');
Route::post('/update-data-diri', 'App\Http\Controllers\dataController@post_data_diri')->name('post_data_diri')->middleware('auth');
Route::post('/update-data-usaha', 'App\Http\Controllers\dataController@post_data_usaha')->name('post_data_usaha')->middleware('auth');
Route::post('/update-legalitas-usaha', 'App\Http\Controllers\dataController@post_legalitas_usaha')->name('post_legalitas_usaha')->middleware('auth');
Route::post('/update-model-bisnis', 'App\Http\Controllers\dataController@post_model_bisnis')->name('post_model_bisnis')->middleware('auth');


/* admin */
Route::get('/login-admin', 'App\Http\Controllers\AdminController@login')->name('login-admin')->middleware('guest');
Route::post('/login-admin', 'App\Http\Controllers\AdminController@post_login')->name('post_login-admin');
/* user */
Route::get('/pedagang_list', 'App\Http\Controllers\AdminController@pedagang_list')->name('pedagang_list-admin')->middleware('auth:webadmin');
Route::post('/pedagang_post', 'App\Http\Controllers\AdminPostController@pedagang_post')->name('pedagang_post-admin')->middleware('auth:webadmin');
Route::get('/forgot_list', 'App\Http\Controllers\AdminController@forgot_list')->name('forgot_list-admin')->middleware('auth:webadmin');
/* event */
Route::get('/pembinaan_list', 'App\Http\Controllers\AdminController@pembinaan_list')->name('pembinaan_list-admin')->middleware('auth:webadmin');
Route::post('/pembinaan_post', 'App\Http\Controllers\AdminPostController@post_pembinaan')->name('pembinaan_post-admin')->middleware('auth:webadmin');
Route::get('/agenda_list', 'App\Http\Controllers\AdminController@agenda_list')->name('agenda_list-admin')->middleware('auth:webadmin');
Route::post('/agenda_post', 'App\Http\Controllers\AdminPostController@post_agenda')->name('agenda_post-admin')->middleware('auth:webadmin');
Route::get('/agenda_delete', 'App\Http\Controllers\AdminPostController@post_agenda')->name('agenda_delete-admin')->middleware('auth:webadmin');
/* barang */
Route::get('/kurasi_list', 'App\Http\Controllers\AdminController@kurasi_list')->name('kurasi_list-admin')->middleware('auth:webadmin');
Route::get('/diskon_list', 'App\Http\Controllers\AdminController@diskon_list')->name('diskon_list-admin')->middleware('auth:webadmin');
Route::post('/kurasi_post', 'App\Http\Controllers\AdminPostController@kurasi_post')->name('kurasi_post-admin')->middleware('auth:webadmin');

Route::get('/index-admin', 'App\Http\Controllers\AdminController@index')->name('index-admin')->middleware('auth:webadmin');
Route::get('/sent-forgot/{id}', 'App\Http\Controllers\AdminController@sent')->name('sent-forgot')->middleware('auth:webadmin');
// Route::post('/login', function () {return dd(get_defined_vars());})->name('post_login');
/* admin end */


// Route::get('/randomfunction', 'App\Http\Controllers\Controller@randomfunction')->name('randomfunction')->middleware('auth:webadmin');