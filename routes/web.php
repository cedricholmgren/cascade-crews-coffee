<?php

use App\Http\Controllers\CoffeeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});

//route for getting orders, storing orders, and updating orders
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('orders', [OrderController::class, 'index'])->name('orders')->middleware('auth');
    Route::post('orders', [OrderController::class, 'store'])->name('orders.store')->middleware('auth');
    Route::put('orders', [OrderController::class, 'update'])->name('orders.update')->middleware('auth');
    Route::get('orders/{order}', [OrderController::class, 'show'])->name('orders.show')->middleware('auth');
    Route::delete('orders/{order}', [OrderController::class, 'destroy'])->name('orders.destroy')->middleware('auth');
});

//route for getting coffees, storing coffees, and updating coffees
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('coffees', [CoffeeController::class, 'index'])->name('coffees')->middleware('auth');
    Route::post('coffees', [CoffeeController::class, 'store'])->name('coffees.store')->middleware('auth');
    Route::put('coffees', [CoffeeController::class, 'update'])->name('coffees.update')->middleware('auth');
    Route::get('coffees/{coffee}', [CoffeeController::class, 'show'])->name('coffees.show')->middleware('auth');
    Route::delete('coffees/{coffee}', [CoffeeController::class, 'destroy'])->name('coffees.destroy')->middleware('auth');
});

//route for getting users, storing users, and updating users
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('users', [UserController::class, 'index'])->name('users')->middleware('auth');
    Route::post('users', [UserController::class, 'store'])->name('users.store')->middleware('auth');
    Route::put('users', [UserController::class, 'update'])->name('users.update')->middleware('auth');
    Route::get('users/{user}', [UserController::class, 'show'])->name('users.show')->middleware('auth');
    Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy')->middleware('auth');
});
