<?php

use App\Http\Controllers\Advertisement\AdvertController;
use App\Http\Controllers\Contract\DocumentExportController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Rental\RentalController;
use App\Http\Controllers\Shop\ShopController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth/register');
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/advertisements', [AdvertController::class, 'index'])->name('advertisements.index');
Route::get('/advertisements/create', [AdvertController::class, 'create'])->name('advertisements.create');
Route::post('/advertisements/store', [AdvertController::class, 'store'])->name('advertisements.store');
Route::get('/advertisements/agenda', [AdvertController::class, 'agenda'])->name('advertisements.agenda');
Route::get('/advertisements/fetch', [AdvertController::class, 'fetchAdvertisementData'])->name('advertisements.fetch');
Route::get('/advertisements/{advertisement}', [AdvertController::class, 'show'])->name('advertisements.show');
Route::get('/advertisements/{advertisement}/edit', [AdvertController::class, 'edit'])->name('advertisements.edit');
Route::put('/advertisements/{advertisement}', [AdvertController::class, 'update'])->name('advertisements.update');
Route::delete('/advertisements/{advertisement}', [AdvertController::class, 'delete'])->name('advertisements.delete');
Route::get('/advertisement/add-to-basket/{advertisement}', [ShopController::class, 'addItem'])->name('advertisements.add');

Route::get('/shoppingbasket', [ShopController::class, 'index'])->name('basket.show');
Route::delete('/shoppingbasket/{basket}', [ShopController::class, 'delete'])->name('basket.delete');

Route::get('/rentals', [RentalController::class, 'index'])->name('rentals.index');
Route::get('/rentals/fetch', [RentalController::class, 'fetchRentalData'])->name('rentals.fetch');
Route::get('/rentals/agenda', [RentalController::class, 'agenda'])->name('rentals.agenda');
Route::get('/rentals/create', [RentalController::class, 'create'])->name('rentals.create');
Route::post('/rentals/store', [RentalController::class, 'store'])->name('rentals.store');
Route::post('/rentals/{rental}', [RentalController::class, 'saveDate'])->name('rentals.date.save');
Route::get('/rentals/{rental}/edit', [RentalController::class, 'edit'])->name('rentals.edit');
Route::get('/rentals/{rental}', [RentalController::class, 'show'])->name('rentals.show');
Route::put('/rentals/{rental}', [RentalController::class, 'update'])->name('rentals.update');
Route::delete('/rentals/{rental}', [RentalController::class, 'delete'])->name('rentals.delete');


Route::get('/export', [DocumentExportController::class, 'generateContract'])->name('export');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
