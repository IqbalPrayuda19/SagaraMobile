<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;

// login & register
Route::get('/', [AuthenticatedSessionController::class, 'create']);
Route::get('/register', [AuthenticatedSessionController::class, 'create']);
// dashboard
Route::get('/dashboard', function () {
    return view('dashboard.section.dashboard.index');
})->middleware(['auth', 'verified'])->name('dashboard');
// assets
Route::get('/assets',[App\Http\Controllers\SagaraController::class, 'getIndex'])->middleware(['auth', 'verified'])->name('getIndex');
// create
Route::get('/create', [App\Http\Controllers\SagaraController::class, 'create'])->middleware(['auth', 'verified'])->name('create');
Route::post('/create', [App\Http\Controllers\SagaraController::class, 'postStore'])->middleware(['auth', 'verified'])->name('postStore');
// edit
Route::get('/edit/{uuid}', [App\Http\Controllers\SagaraController::class, 'getEdit'])->middleware(['auth', 'verified'])->name('getEdit');
Route::post('/edit/{uuid}', [App\Http\Controllers\SagaraController::class, 'postUpdate'])->middleware(['auth', 'verified'])->name('postUpdate');
// delete
Route::post('/delete/{uuid}', [App\Http\Controllers\SagaraController::class, 'destroy'])->middleware(['auth', 'verified'])->name('destroy');
//setting sama fadhlan
Route::get('/settings', function () {
    return view('dashboard.section.settings.index');
})->middleware(['auth', 'verified'])->name('settings');

Route::get('/createCategory', function () {
    return view('dashboard.section.createCategory.index');
})->middleware(['auth', 'verified'])->name('settings');

Route::get('/createLocation', function () {
    return view('dashboard.section.createLocation.index');
})->middleware(['auth', 'verified'])->name('createLocation');

// auth
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
