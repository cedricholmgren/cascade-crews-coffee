<?php

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
    Route::get('/orders', 'App\Http\Controllers\OrderController@index')->name('orders');
    Route::post('/orders', 'App\Http\Controllers\OrderController@store')->name('orders.store');
    Route::put('/orders', 'App\Http\Controllers\OrderController@update')->name('orders.update');
    Route::get('/orders/{order}', 'App\Http\Controllers\OrderController@show')->name('orders.show');
    Route::delete('/orders/{order}', 'App\Http\Controllers\OrderController@destroy')->name('orders.destroy');
});

//route for getting coffees, storing coffees, and updating coffees
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/coffees', 'App\Http\Controllers\CoffeeController@index')->name('coffees');
    Route::post('/coffees', 'App\Http\Controllers\CoffeeController@store')->name('coffees.store');
    Route::put('/coffees', 'App\Http\Controllers\CoffeeController@update')->name('coffees.update');
    Route::get('/coffees/{coffee}', 'App\Http\Controllers\CoffeeController@show')->name('coffees.show');
    Route::delete('/coffees/{coffee}', 'App\Http\Controllers\CoffeeController@destroy')->name('coffees.destroy');
});

//route for getting users, storing users, and updating users
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/users', 'App\Http\Controllers\UserController@index')->name('users');
    Route::post('/users', 'App\Http\Controllers\UserController@store')->name('users.store');
    Route::put('/users', 'App\Http\Controllers\UserController@update')->name('users.update');
    Route::get('/users/{user}', 'App\Http\Controllers\UserController@show')->name('users.show');
    Route::delete('/users/{user}', 'App\Http\Controllers\UserController@destroy')->name('users.destroy');
});
