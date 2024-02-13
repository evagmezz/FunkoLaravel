<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FunkoController;
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
    return redirect()->route('funkos.index');
});

Route::group(['prefix' => 'funkos'], function () {
    Route::get('/', [FunkoController::class, 'index'])->name('funkos.index');
    Route::get('/create', [FunkoController::class, 'create'])->name('funkos.create');
    Route::post('/', [FunkoController::class, 'store'])->name('funkos.store');
    Route::get('/{id}', [FunkoController::class, 'show'])->name('funkos.show');
    Route::get('/{id}/edit', [FunkoController::class, 'edit'])->name('funkos.edit');
    Route::put('/{id}', [FunkoController::class, 'update'])->name('funkos.update');
    Route::get('/{id}/update-image', [FunkoController::class, 'editImg'])->name('funkos.editImg');
    Route::patch('/{id}/update-image', [FunkoController::class, 'updateImg'])->name('funkos.updateImg');
    Route::delete('/{id}', [FunkoController::class, 'destroy'])->name('funkos.destroy');
});

Route::group(['prefix' => 'categories'], function () {
    Route::get('/', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/{id}', [CategoryController::class, 'show'])->name('categories.show');
    Route::get('/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/{id}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');
});



