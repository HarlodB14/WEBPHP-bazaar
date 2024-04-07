<?php

use App\Http\Controllers\Advertisement\AdvertController;
use App\Http\Controllers\componentController;
use App\Http\Controllers\Contract\DocumentExportController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\LandingPage\LandingPageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Rental\RentalController;
use App\Http\Controllers\Bid\BidController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth/register');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/custom-url', [LandingPageController::class, 'setCustomUrl'])->name('custom-url.set');
    Route::get('/landing-page/create', [LandingPageController::class, 'create'])->name('landing-page.create');
    Route::post('/components', [ComponentController::class, 'store'])->name('components.store');
    Route::post('/components/add', [ComponentController::class, 'add'])->name('add.advertisement');
    Route::get('/image-upload', [ImageController::class, 'index'])->name('image.form');
    Route::post('/upload-image', [ImageController::class, 'storeImage'])->name('image.store');

    Route::prefix('advertisements')->group(function () {
        Route::get('/', [AdvertController::class, 'index'])->name('advertisements.index');
        Route::get('/create', [AdvertController::class, 'create'])->name('advertisements.create');
        Route::post('/store', [AdvertController::class, 'store'])->name('advertisements.store');
        Route::get('/agenda', [AdvertController::class, 'agenda'])->name('advertisements.agenda');
        Route::get('/fetch', [AdvertController::class, 'fetchAdvertisementData'])->name('advertisements.fetch');
        Route::get('/{advertisement}', [AdvertController::class, 'show'])->name('advertisements.show');
        Route::get('/{advertisement}/edit', [AdvertController::class, 'edit'])->name('advertisements.edit');
        Route::put('/{advertisement}', [AdvertController::class, 'update'])->name('advertisements.update');
        Route::delete('/{advertisement}', [AdvertController::class, 'delete'])->name('advertisements.delete');
        Route::post('/placebid/{advertisement}', [BidController::class, 'placeBid'])->name('bids.place');
        Route::get('/my-bids', [BidController::class, 'index'])->name('bid.show');
        Route::delete('/my-bids/{bid}', [BidController::class, 'delete'])->name('bid.delete');
    });

    Route::prefix('rentals')->group(function () {
        Route::get('/', [RentalController::class, 'index'])->name('rentals.index');
        Route::get('/fetch', [RentalController::class, 'fetchRentalData'])->name('rentals.fetch');
        Route::get('/agenda', [RentalController::class, 'agenda'])->name('rentals.agenda');
        Route::get('/create', [RentalController::class, 'create'])->name('rentals.create');
        Route::post('/store', [RentalController::class, 'store'])->name('rentals.store');
        Route::post('/{rental}', [RentalController::class, 'saveDate'])->name('rentals.date.save');
        Route::get('/{rental}/edit', [RentalController::class, 'edit'])->name('rentals.edit');
        Route::get('/{rental}', [RentalController::class, 'show'])->name('rentals.show');
        Route::put('/{rental}', [RentalController::class, 'update'])->name('rentals.update');
        Route::delete('/{rental}', [RentalController::class, 'delete'])->name('rentals.delete');
    });

    Route::get('/export', [DocumentExportController::class, 'generateContract'])->name('export');

    Route::get('/custom/{customUrl}', [LandingPageController::class, 'showLandingPage'])->name('landing-page.show');
});

require __DIR__ . '/auth.php';
