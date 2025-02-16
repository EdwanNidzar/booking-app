<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PenginapanController;
use App\Http\Controllers\PropertieController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\BookingController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PaymentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [LandingPageController::class, 'index'])->name('landing-page');
Route::post('/booking/{id}', [LandingPageController::class, 'booking'])->name('booking');
Route::get('/receipt', [LandingPageController::class, 'receipt'])->name('receipt');

Route::get('/dashboard', function () {
    return Auth::check() && Auth::user()->hasRole('user') ? redirect()->route('landing-page') : view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::view('about', 'about')->name('about');

    Route::get('users', [UserController::class, 'index'])->name('users.index');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('penginapan', PenginapanController::class)->middleware('auth');

Route::resource('properties', PropertieController::class)->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::get('bookings/{booking}', [BookingController::class, 'show'])->name('bookings.show');
    Route::patch('bookings/{booking}/approved', [BookingController::class, 'updateStatusApproved'])->name('bookings.approved');
    Route::patch('bookings/{booking}/rejected', [BookingController::class, 'updateStatusRejected'])->name('bookings.rejected');
});

Route::get('/cart', [BookingController::class, 'cart'])->name('cart');

Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');
Route::get('/payments/create/{id}', [PaymentController::class, 'create'])->name('payments.create');
Route::post('/payments', [PaymentController::class, 'store'])->name('payments.store');

require __DIR__.'/auth.php';
