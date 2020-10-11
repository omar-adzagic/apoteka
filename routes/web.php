<?php

Route::view('/', 'index');

// Medicines
Route::get('/medicines/sort/{parametar}', 'MedicinesController@sort')->name('medicines.sort');
Route::resource('medicines', 'MedicinesController');

// Medicine Types
Route::get('/medicineTypes/sort/{parametar}', 'MedicineTypesController@sort')->name('medicineTypes.sort');
Route::resource('medicineTypes', 'MedicineTypesController');

// Receipts
Route::get('/receipts/sort/{parametar}', 'ReceiptsController@sort')->name('receipts.sort');
Route::post('/receipts/medicineNumber', 'ReceiptsController@medicineNumber')->name('receipts.medicineNumber');
Route::get('/receipts/{medicine}/createSingle', 'ReceiptsController@createSingle')->name('receipts.createSingle');
Route::post('/receipts/storeSingle', 'ReceiptsController@storeSingle')->name('receipts.storeSingle');
Route::resource('receipts', 'ReceiptsController');

// Orders
Route::get('/orders/sort/{parametar}', 'OrdersController@sort')->name('orders.sort');
Route::post('/orders/medicineNumber', 'OrdersController@medicineNumber')->name('orders.medicineNumber');
Route::resource('/orders', 'OrdersController');

// Users
Route::get('/users/sort/{parametar}', 'UsersController@sort')->name('users.sort');
Route::resource('users', 'UsersController');

Auth::routes();

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');
