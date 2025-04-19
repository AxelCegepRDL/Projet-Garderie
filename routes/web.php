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

// Route for the CommerceController
Route::get('/commerce', 'App\Http\Controllers\CommerceController@index')->name('commerce.list');
Route::get('/commerce/{id}/edit', 'App\Http\Controllers\CommerceController@formModify')->name('commerce.edit.form');
Route::post('/commerce/add', 'App\Http\Controllers\CommerceController@add')->name('commerce.add');
Route::put('/commerce/{id}/update', 'App\Http\Controllers\CommerceController@update')->name('commerce.update');
Route::delete('/commerce/{id}/delete', 'App\Http\Controllers\CommerceController@delete')->name('commerce.delete');
Route::delete('/commerce/clear', 'App\Http\Controllers\CommerceController@clear')->name('commerce.clear');

// Routes for the EducatorController :
Route::get('/Educator', 'App\Http\Controllers\EducatorController@index')->name('List educator');
Route::get('/Educator/{id}/edit', 'App\Http\Controllers\EducatorController@formModifyEducator')->name('Form modify educator');
Route::post('/Educator/add', 'App\Http\Controllers\EducatorController@add')->name('Add an educator');
Route::put('/Educator/{id}/update', 'App\Http\Controllers\EducatorController@update')->name('Modify educator');
Route::delete('/Educator/{id}/delete', 'App\Http\Controllers\EducatorController@delete')->name('Delete educator');
Route::delete('/Educator/clear', 'App\Http\Controllers\EducatorController@clear')->name('Clear list educator');

// Route for the ChildController
Route::get('/child', 'App\Http\Controllers\ChildController@index')->name('child.list');
Route::get('/child/{id}/edit', 'App\Http\Controllers\ChildController@formModify')->name('child.edit.form');
Route::post('/child/add', 'App\Http\Controllers\ChildController@add')->name('child.add');
Route::put('/child/{id}/update', 'App\Http\Controllers\ChildController@update')->name('child.update');
Route::delete('/child/{id}/delete', 'App\Http\Controllers\ChildController@delete')->name('child.delete');
Route::delete('/child/clear', 'App\Http\Controllers\ChildController@clear')->name('child.clear');
