<?php

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

Route::get('/', 'HomeController@index')->name('beranda');
Route::get('/tanah/{slug}', 'HomeController@tanahShow')->name('tanahShow');
Route::get('/api/kampung/{kecamatan}', 'HomeController@kampung');
Route::get('/tanah/terdekat/{lat}/{lng}', 'HomeController@nearby')->name('nearby');
Route::get('/tanah/kecamatan/{kecamatan}', 'HomeController@tanahKecamatan')->name('tanahKecamatan');
Route::get('/tanah/kota/{kota}', 'HomeController@tanahKota')->name('tanahKota');
// Route::get('/{kota}', 'HomeController@tanahKota')->name('tanahKota');
Route::get('/search', 'HomeController@search')->name('search');

Auth::routes();
// Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin/dashboard', 'AdminController@index')->name('dashboardAdmin')->middleware('admin');
Route::get('/admin/penjual/verif', 'AdminController@indexPenjual')->name('indexPenjual')->middleware('admin');
Route::get('/admin/penjual/unverif', 'AdminController@indexPenjualUn')->name('indexPenjualUn')->middleware('admin');
Route::get('/admin/penjual/banned', 'AdminController@indexPenjualBan')->name('indexPenjualBan')->middleware('admin');
Route::put('/admin/penjual/status/{id}', 'AdminController@statusPenjual')->name('statusPenjual')->middleware('admin');
Route::get('/admin/tanah/verif', 'AdminController@indexTanah')->name('indexAdminTanah')->middleware('admin');
Route::get('/admin/tanah/unverif', 'AdminController@indexTanahUn')->name('indexAdminTanahUn')->middleware('admin');
Route::get('/admin/tanah/banned', 'AdminController@indextanahBan')->name('indexAdminTanahBan')->middleware('admin');
Route::put('/admin/tanah/status/{id}', 'AdminController@statusTanah')->name('statusTanah')->middleware('admin');
Route::delete('/admin/tanah/delete/{tanah}', 'AdminController@deleteTanah')->name('adminDeleteTanah')->middleware('admin');
Route::get('/admin/profile', 'AdminController@profile')->name('admin.profile')->middleware('admin');
Route::put('/admin/profile', 'AdminController@updateProfile')->name('updateProfile')->middleware('admin');
Route::get('/admin/data-admin', 'AdminController@dataAdmin')->name('dataAdmin')->middleware('admin');
Route::get('/admin/add-admin', 'AdminController@addAdmin')->name('addAdmin')->middleware('admin');
Route::post('/admin/add-admin', 'AdminController@storeAdmin')->name('storeAdmin')->middleware('admin');

Route::get('/penjual/dashboard', 'PenjualController@index')->name('dashboardPenjual')->middleware('penjual');
Route::get('/penjual/tanah', 'PenjualController@indexTanah')->name('indexTanah')->middleware('penjual');
Route::get('/penjual/tanah/add', 'PenjualController@addTanah')->name('addTanah')->middleware('penjual');
Route::post('/penjual/tanah/add', 'PenjualController@storeTanah')->name('storeTanah')->middleware('penjual');
Route::get('/penjual/tanah-overlay/{id}', 'PenjualController@addOverlay')->name('addOverlay')->middleware('penjual');
Route::post('/penjual/tanah-overlay/{id}', 'PenjualController@storeOverlay')->name('storeOverlay')->middleware('penjual');
Route::get('/penjual/tanah/edit/{id}', 'PenjualController@editTanah')->name('editTanah')->middleware('penjual');
Route::put('/penjual/tanah/edit/{id}', 'PenjualController@updateTanah')->name('updateTanah')->middleware('penjual');
Route::put('/penjual/tanah/sold/{tanah}', 'PenjualController@soldTanah')->name('soldTanah')->middleware('penjual');
Route::delete('/penjual/tanah/delete/{tanah}', 'PenjualController@deleteTanah')->name('deleteTanah')->middleware('penjual');
Route::get('/penjual/profile', 'PenjualController@profile')->name('penjual.profile')->middleware('penjual');
Route::put('/penjual/profile', 'PenjualController@updateProfile')->name('penjualupdateProfile')->middleware('penjual');