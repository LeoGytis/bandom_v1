<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\DishController;
use App\Http\Controllers\OrderController;
use App\Models\Restaurant;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// ========================== Restaurant ==========================
Route::prefix('restaurants')->controller(RestaurantController::class)->name('restaurant.')->group(function(){
    Route::get('', 'index')->name('index')->middleware('rp:user');
    Route::get('create', 'create')->name('create')->middleware('rp:admin');
    Route::post('store', 'store')->name('store')->middleware('rp:admin');
    Route::get('edit/{restaurant}', 'edit')->name('edit')->middleware('rp:admin');
    Route::put('update/{restaurant}', 'update')->name('update')->middleware('rp:admin');
    Route::post('delete/{restaurant}', 'destroy')->name('destroy')->middleware('rp:admin');
    Route::get('show/{restaurant}', 'show')->name('show')->middleware('rp:user');
 });
 


// ========================== Dish ==========================
Route::prefix('dishes')->controller(DishController::class)->name('dish.')->group(function () {
    Route::get('', 'index')->name('index')->middleware('rp:user');
    Route::get('create', 'create')->name('create')->middleware('rp:admin');
    Route::post('store', 'store')->name('store')->middleware('rp:admin');
    Route::get('edit/{dish}', 'edit')->name('edit')->middleware('rp:admin');
    Route::put('update/{dish}', 'update')->name('update')->middleware('rp:admin');
    Route::post('delete/{dish}', 'destroy')->name('destroy')->middleware('rp:admin');
    Route::get('show/{dish}', 'show')->name('show')->middleware('rp:user');
    Route::put('delete-picture/{dish}', 'deletePicture')->name('delete-picture')->middleware('rp:admin');
});


// ========================== Order ==========================
Route::prefix('orders')->controller(OrderController::class)->name('order.')->group(function () {
    Route::get('', 'index')->name('index')->middleware('rp:admin');
    Route::post('add', 'add')->name('add');
    Route::post('delete/{order}', 'destroy')->name('destroy')->middleware('rp:admin');
    Route::put('status/{order}', 'setStatus')->name('status')->middleware('rp:admin');
    Route::get('show', 'showMyOrders')->name('show');
});
