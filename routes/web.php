<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NurseryController;

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

Route::get('/', 'App\Http\Controllers\NurseryController@index')->name('List nursery');

Route::get('/Garderies', 'App\Http\Controllers\NurseryController@index')->name('nursery');
Route::get('/garderies/{id}/edit', 'App\Http\Controllers\NurseryController@formModifyNursery')->name('Form modify nursery');
