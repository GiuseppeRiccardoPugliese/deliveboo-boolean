<?php

use App\Http\Controllers\DishController;
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
Route::get('/', [RestaurantController::class, 'index'])->name('restaurant.index');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //Rotta INDEX PIATTI
    Route::get('/dishes', [DishController::class, 'index'])->name('dish.index');

    //Rotta CREATE RISTORANTI
    Route::get('/restaurants/create', [RestaurantController::class, 'create'])->name('restaurant.create');

    //Rotta STORE RISTORANTI
    Route::put('/restaurants/create/{id}', [RestaurantController::class, 'store'])->name('restaurant.store');

    //Rotta DELETE RISTORANTI
    Route::delete('/restaurants/{id}', [RestaurantController::class, 'destroy'])->name('restaurants.destroy');

    //Rotta SHOW RISTORANTI
    Route::get('/restaurant{id}', [RestaurantController::class, 'show'])->name('restaurant.show');

    //Rotta CREATE DISH
    Route::get('/dishes/create', [DishController::class, 'create'])->name('dish.create');

    //Rotta STORE DISH
    Route::post('/dishes/create', [DishController::class, 'store'])->name('dish.store');

    //Rotta SHOW DISH
    Route::get('/dishes/{id}', [DishController::class, 'show'])->name('dish.show');

    //Rotta EDIT DISH
    Route::get('/dishes/{id}/edit', [DishController::class, 'edit'])->name('dish.edit');

    //Rotta UPDATE DISH
    Route::put('/dishes/{id}/edit', [DishController::class, 'update'])->name('dish.update');

    //Rotta DELETE DISH
    Route::delete('/dishes/{id}', [DishController::class, 'destroy'])->name('dish.destroy');
});

require __DIR__ . '/auth.php';
