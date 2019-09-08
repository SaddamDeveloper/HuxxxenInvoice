<?php

Route::get('/', 'InvoiceController@index')->name('invoices.index');

Route::get('/create', 'InvoiceController@create')->name('invoices.create');
Route::post('/invoices', 'InvoiceController@store');
Route::put('edit/invoices/{id}', 'InvoiceController@update');
Route::get('edit/{id}', 'InvoiceController@edit')->name('invoices.edit');
Route::get('/show/{id}', 'InvoiceController@show')->name('invoices.show');
Route::delete('/destroy/{id}', 'InvoiceController@destroy')->name('invoices.destroy');

