<?php

use App\Http\Controllers\Contract\DocumentExportController;
use App\Http\Controllers\ProfileController;
use App\Http\rental\AdvertController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth/register');
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/advertisements', [AdvertController::class, 'index'])->name('advertisements');
//Route::get('/advertisements', [AdvertController::class, 'edit'])->name('advertisements');
Route::post('/publish', [AdvertController::class, 'store'])->name('store');
Route::get('/advertisements/create-new-advertisement', [AdvertController::class, 'create'])->name('create');
Route::get('/create-new-advertisement', [AdvertController::class, 'create'])->name('create-new-advertisement');

Route::get('/export', [DocumentExportController::class, 'generateContract'])->name('export');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
