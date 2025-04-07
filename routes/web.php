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

//Route for the ExpenseCategoryController
Route::get('/ExpenseCategory', 'App\Http\Controllers\ExpenseCategoryController@index')->name('List the expense categories');
Route::get('/ExpenseCategory/{id}/edit', 'App\Http\Controllers\ExpenseCategoryController@formModifyExpenseCategory')->name('Form modify expense category');
Route::post('/ExpenseCategory/add', 'App\Http\Controllers\ExpenseCategoryController@add')->name('Add an expense category');
Route::put('/ExpenseCategory/{id}/update', 'App\Http\Controllers\ExpenseCategoryController@update')->name('Update an expense category');
Route::delete('/ExpenseCategory/{id}/delete', 'App\Http\Controllers\ExpenseCategoryController@delete')->name('Delete an expense category');
Route::delete('/ExpenseCategory/clear', 'App\Http\Controllers\ExpenseCategoryController@clear')->name('Clear list expense categories');