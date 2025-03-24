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

Route::get('/', function () {
    return view('nursery');
})->name('List nursery');

Route::get('/Garderies', function(){return view('nursery');})->name('nursery');
Route::get('/garderies/{id}/edit', [NurseryController::class, formModifyNursery($id)])->name('Form modify nursery');