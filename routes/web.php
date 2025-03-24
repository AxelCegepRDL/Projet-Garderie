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

Route::get('/', 'App/Http/Controllers/NurseryController@index')->name('List nursery');
Route::get('/Garderies', 'App/Http/Controllers/NurseryController@index')->name('List nursery');
Route::get('/garderies/{id}/edit', 'App/Http/Controllers/NurseryController@formModifyNursery')->name('Form modify nursery');
Route::post('/garderies/add', 'App/Http/Controllers/NurseryController@add')->name('Add a nursery');
Route::put('/garderies/{id}/update', 'App/Http/Controllers/NurseryController@update')->name('Modify nursery');
Route::delete('/garderies/{id}/delete', 'App/Http/Controllers/NurseryController@delete')->name('Delete nursery');
Route::delete('/garderies/clear', 'App/Http/Controllers/NurseryController@clear')->name('Clear list nursery');