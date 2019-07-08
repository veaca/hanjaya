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
    return redirect('customer');
});

Route::get('/views', function () {
    return view('views');
});

Route::resource('customer', 'CustomerController');
Route::resource('invoice', 'InvoiceController');
Route::resource('nota', 'NotaController');
Route::resource('notadetail', 'NotaDetailController');
Route::resource('project', 'ProjectController');
Route::resource('vendor', 'VendorController');
Route::resource('biaya', 'BiayaLainController');
Route::resource('laporan', 'LaporanController');
Route::resource('print', 'PrintController');
Route::resource('printinvoice', 'PrintInvoiceController');
Route::resource('printnota', 'PrintNotaController');
Route::resource('invoicenota', 'InvoiceNotaController');
Route::get('/exportInvoice/{id}', 'ExportController@exportInvoice');
Route::get('/exportNota/{id}', 'ExportController@exportNota');
Route::get('/periodeLaporan', 'ExportController@periodeLaporan');
Route::post('/exportLaporan', 'ExportController@exportLaporan');
Route::get('/viewInvoice/{id}', 'ExportController@viewInvoice');
Route::get('/viewNota/{id}', 'ExportController@viewNota');