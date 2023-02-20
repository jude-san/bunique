<?php

use App\Http\Controllers\ActivitiesController;
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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::prefix('activities')->group(function () {
    Route::get('/', [ActivitiesController::class, 'index'])->name('activity.index');
    Route::post('store', [ActivitiesController::class, 'store'])->name('activity.store');
    Route::get('edit/{note}', [ActivitiesController::class, 'edit'])->name('activity.edit');
    Route::post('update/{note}', [ActivitiesController::class, 'update'])->name('activity.update');
    Route::get('delete/{note}', [ActivitiesController::class, 'delete'])->name('activity.delete');
});
