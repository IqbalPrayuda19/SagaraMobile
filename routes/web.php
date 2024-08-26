<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthenticatedSessionController::class, 'create']);

Route::get('/dashboard', function () {
    return view('dashboard.section.dashboard.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/assets', function () {
    return view('dashboard.section.assets.index');
})->middleware(['auth', 'verified'])->name('assets');

Route::get('/create', function () {
    return view('dashboard.section.create.index');
})->middleware(['auth', 'verified'])->name('create');

Route::get('/view', function () {
    return view('dashboard.section.view.index');
})->middleware(['auth', 'verified'])->name('view');

Route::get('/edit', function () {
    return view('dashboard.section.edit.index');
})->middleware(['auth', 'verified'])->name('edit');

Route::get('/delete', function () {
    return view('dashboard.section.delete.index');
})->middleware(['auth', 'verified'])->name('delete');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
