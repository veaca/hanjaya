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

Route::get('/', function () {
    return view('views');
});

Route::get('/views', function () {
    return view('views');
});


Route::group(['middleware'=>'auth'], function() {
Route::resource('customer', 'CustomerController');
Route::resource('invoice', 'InvoiceController');
Route::resource('nota', 'NotaController');
Route::resource('project', 'ProjectController');
Route::resource('vendor', 'VendorController');
Route::resource('biaya', 'BiayaLainController');
Route::resource('laporan', 'LaporanController');
Route::resource('printinvoice', 'PrintInvoiceController');
Route::resource('printnota', 'PrintNotaController');
Route::resource('invoicenota', 'InvoiceNotaController');
Route::resource('management', 'ManagementController');
Route::get('/exportInvoice/{id}', 'ExportController@exportInvoice');
Route::get('/exportNota/{id}', 'ExportController@exportNota');
Route::get('/periodeLaporan', 'ExportController@periodeLaporan');
Route::post('/exportLaporan', 'ExportController@exportLaporan');
Route::get('/viewInvoice/{id}', 'ExportController@viewInvoice');
Route::get('/viewNota/{id}', 'ExportController@viewNota');
Route::get('/downloadLaporan/{awal}/{akhir}/{tahun}', 'ExportController@downloadLaporan');
});

Auth::routes();
Route::get('views', function(){
    return view('views');
});
Route::get('/home', 'HomeController@index')->name('home');
