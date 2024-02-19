<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FunkoController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return redirect()->route('funkos.index');
});

Route::group(['prefix' => 'funkos'], function () {
    Route::get('/', [FunkoController::class, 'index'])->name('funkos.index');
    Route::get('/create', [FunkoController::class, 'create'])->name('funkos.create')->middleware(['auth', 'admin']);
    Route::post('/', [FunkoController::class, 'store'])->name('funkos.store')->middleware(['auth', 'admin']);
    Route::get('/{id}', [FunkoController::class, 'show'])->name('funkos.show');
    Route::get('/edit/{id}', [FunkoController::class, 'edit'])->name('funkos.edit')->middleware(['auth', 'admin']);
    Route::put('/edit/{id}', [FunkoController::class, 'update'])->name('funkos.update')->middleware(['auth', 'admin']);
    Route::get('/update-image/{id}', [FunkoController::class, 'editImg'])->name('funkos.editImg');
    Route::patch('/update-image/{id}', [FunkoController::class, 'updateImg'])->name('funkos.updateImg')->middleware(['auth', 'admin']);
    Route::delete('/delete/{id}', [FunkoController::class, 'destroy'])->name('funkos.destroy')->middleware(['auth', 'admin']);
});

Route::group(['prefix' => 'category'], function () {
    Route::get('/', [CategoryController::class, 'index'])->name('category.index')->middleware(['auth', 'admin']);
    Route::get('/create', [CategoryController::class, 'store'])->name('category.store')->middleware(['auth', 'admin']);
    Route::post('/create', [CategoryController::class, 'create'])->name('category.create')->middleware(['auth', 'admin']);
    Route::get('/{id}', [CategoryController::class, 'show'])->name('category.show')->middleware(['auth', 'admin']);
    Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit')->middleware(['auth', 'admin']);
    Route::put('/edit/{id}', [CategoryController::class, 'update'])->name('category.update')->middleware(['auth', 'admin']);
    Route::delete('/delete/{id}', [CategoryController::class, 'destroy'])->name('category.destroy')->middleware(['auth', 'admin']);
    Route::put('/activate/{id}', [CategoryController::class, 'activate'])->name('category.activate')->middleware(['auth', 'admin']);
});

Auth::routes();

