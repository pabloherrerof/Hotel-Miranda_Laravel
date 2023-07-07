<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\OffersController;
use App\Http\Controllers\RoomDetailController;
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

Route::get('/about', function () {
    return view('about');
});

Route::get('/rooms',[RoomsController::class, 'show']);
Route::get('/room-detail/{id}',[RoomDetailController::class, 'show']);
Route::post('/room-detail/{id}',[RoomDetailController::class, 'post']);
Route::get('/offers',[OffersController::class, 'show']);
Route::get('/contact',[ContactController::class, 'show']);
Route::post('/contact',[ContactController::class, 'post']);
Route::get('/',[IndexController::class, 'show']);
