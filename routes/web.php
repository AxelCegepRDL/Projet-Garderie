<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Routes for the NurseryController :
Route::get('/', 'App\Http\Controllers\NurseryController@index')->name('List nursery');
Route::get('/Garderies', 'App\Http\Controllers\NurseryController@index')->name('List nursery');
Route::get('/garderies/{id}/edit', 'App\Http\Controllers\NurseryController@formModifyNursery')->name('Form modify nursery');
Route::post('/garderies/add', 'App\Http\Controllers\NurseryController@add')->name('Add a nursery');
Route::put('/garderies/{id}/update', 'App\Http\Controllers\NurseryController@update')->name('Modify nursery');
Route::delete('/garderies/{id}/delete', 'App\Http\Controllers\NurseryController@delete')->name('Delete nursery');
Route::delete('/garderies/clear', 'App\Http\Controllers\NurseryController@clear')->name('Clear list nursery');

//Route for the ExpenseController :
Route::get('/Expense', 'App\Http\Controllers\ExpenseController@index')->name('List the expenses');
Route::get('/Expenses/{id}/edit', 'App\Http\Controllers\ExpenseController@formModifyExpense')->name('Form modify expense');
Route::post('/Expenses/ajouter', 'App\Http\Controllers\ExpenseController@add')->name('Add a expense');
Route::put('/Expenses/{id}/update', 'App\Http\Controllers\ExpenseController@update')->name('Modify a expense');
Route::delete('/Expenses/{id}/delete', 'App\Http\Controllers\ExpenseController@delete')->name('Delete a expense');
Route::delete('/Expenses/{id}/clear', 'App\Http\Controllers\ExpenseController@clear')->name('Clear list expenses');

// Route for the CommerceController
Route::get('/commerce', 'App\Http\Controllers\CommerceController@index')->name('commerce.list');
Route::get('/commerce/{id}/edit', 'App\Http\Controllers\CommerceController@formModify')->name('commerce.edit.form');
Route::post('/commerce/add', 'App\Http\Controllers\CommerceController@add')->name('commerce.add');
Route::post('/commerce/{id}/update', 'App\Http\Controllers\CommerceController@update')->name('commerce.update');
Route::delete('/commerce/{id}/delete', 'App\Http\Controllers\CommerceController@delete')->name('commerce.delete');
Route::delete('/commerce/clear', 'App\Http\Controllers\CommerceController@clear')->name('commerce.clear');
