<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RestaurantController;
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

//Rotta in Index RISTORANTI
Route::get('/restaurants', [RestaurantController::class, 'index'])->name('restaurant.index');







Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    //Rotta CREATE RISTORANTI
    Route::get('/restaurants/create', [RestaurantController::class, 'create'])->name('restaurant.create');

    //Rotta STORE RISTORANTI
    Route::post('/restaurants/create', [RestaurantController::class, 'store'])->name('restaurant.store');
});

require __DIR__ . '/auth.php';
