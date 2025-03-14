<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\ProfileController;
use App\Models\Location;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\SocialiteController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/register', [RegisterController::class, 'create'])
    ->middleware('guest')
    ->name('register');
Route::post('/register', [RegisterController::class, 'store'])
    ->middleware('guest');


// Dashboard Routes
// Route::get('/passenger-dashboard', function () {
//     return view('passenger-dashboard');
// })->middleware('auth');

Route::get('/driver-dashboard', function () {
    return view('driver-dashboard');
})->middleware('auth')->name('driver-dashboard');


// Passenger Routes
// Route::middleware('auth')->group(function () {
//     Route::get('/book-trip', [BookingController::class, 'create'])->name('book-trip');
//     // Route::post('/book-trip', [BookingController::class, 'store']);
//     Route::get('/trip-history', [BookingController::class, 'history'])->name('trip-history');
//     Route::post('/cancel-booking/{booking}', [BookingController::class, 'cancel'])->name('cancel-booking');
// });

// Passenger Dashboard Route
Route::get('/passenger-dashboard', function () {
    try {
        $locations = Location::all();
        return view('passenger-dashboard', compact('locations'));
    } catch (\Exception $e) {

        dd($e->getMessage());
    }
})->middleware('auth')->name('passenger-dashboard');


// Booking Routes
Route::middleware('auth')->group(function () {
    Route::get('/book-trip', [BookingController::class, 'create'])->name('book-trip');
    Route::post('/book-trip', [BookingController::class, 'store'])->name('book-trip.store');
    Route::get('/trip-history', [BookingController::class, 'history'])->name('trip-history');
    Route::post('/cancel-booking/{booking}', [BookingController::class, 'cancel'])->name('cancel-booking');
    Route::get('/filter-drivers', [BookingController::class, 'filterDrivers'])->name('filter-drivers');

});

Route::middleware('auth')->group(function () {
    // Accepter une réservation
    Route::post('/driver/bookings/{booking}/accept', [DriverController::class, 'acceptBooking'])
        ->name('driver.bookings.accept');

    // Refuser une réservation
    Route::post('/driver/bookings/{booking}/reject', [DriverController::class, 'rejectBooking'])
        ->name('driver.bookings.reject');
});

Route::middleware('auth')->group(function () {
    // Afficher les demandes de trajet
    Route::get('/trip-requests', [DriverController::class, 'tripRequests'])
        ->name('driver.trip-requests');
});



Route::middleware('auth')->group(function () {
    // Afficher la page de disponibilité
    Route::get('/availability', [DriverController::class, 'showAvailability'])
        ->name('driver.availability');

    // Mettre à jour la disponibilité
    Route::post('/availability', [DriverController::class, 'updateAvailability'])
        ->name('driver.update-availability');
});



Route::get('auth/google', [SocialiteController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('auth/google/callback', [SocialiteController::class, 'handleGoogleCallback']);

Route::get('auth/facebook', [SocialiteController::class, 'redirectToFacebook'])->name('auth.facebook');
Route::get('auth/facebook/callback', [SocialiteController::class, 'handleFacebookCallback']);
require __DIR__.'/auth.php';
