<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\OffersController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoomsController;
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



Route::get('/dashboard', [OrdersController::class, 'show'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/rooms',[RoomsController::class, 'show']);
Route::get('/about',[AboutController::class, 'show']);
Route::get('/rooms/{id}',[RoomsController::class, 'showSingle']);
Route::post('/rooms/{id}',[BookingController::class, 'create']);
Route::get('/offers',[OffersController::class, 'show']);
Route::get('/contact',[ContactController::class, 'show']);
Route::post('/contact',[ContactController::class, 'create']);
Route::get('/',[IndexController::class, 'show']);

require __DIR__.'/auth.php';
