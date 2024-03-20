<?php

use App\Http\Controllers\Contract\DocumentExportController;
use App\Http\Controllers\ProfileController;
use App\Http\rental\RentalController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth/register');
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/advertisements', [RentalController::class, 'index'])->name('advertisements');
Route::post('/publish', [RentalController::class, 'store'])->name('publish');
Route::get('/create-new-advertisement.blade.php', [RentalController::class, 'create'])->name('create');
Route::get('/create-new-advertisement', [RentalController::class, 'create'])->name('create-new-advertisement');

Route::get('/export', [DocumentExportController::class, 'generateContract'])->name('export');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
