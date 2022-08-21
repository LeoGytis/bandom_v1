<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\HotelController as Hotel;
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
    Route::get('', 'index')->name('index');
    Route::get('create', 'create')->name('create');
    Route::post('store', 'store')->name('store');
    Route::get('edit/{restaurant}', 'edit')->name('edit');
    Route::post('update/{restaurant}', 'update')->name('update');
    Route::post('delete/{restaurant}', 'destroy')->name('destroy');
    Route::get('show/{restaurant}', 'show')->name('show');
 });
 


// ========================== Hotel ==========================
Route::prefix('hotels')->controller(Hotel::class)->group(function () {
    Route::get('', 'index')->name('hotel.index')->middleware('rp:user');
    Route::get('create', 'create')->name('hotel.create')->middleware('rp:admin');
    Route::post('store', 'store')->name('hotel.store')->middleware('rp:admin');
    Route::get('edit/{hotel}', 'edit')->name('hotel.edit')->middleware('rp:admin');
    Route::put('update/{hotel}', 'update')->name('hotel.update')->middleware('rp:admin');
    Route::post('delete/{hotel}', 'destroy')->name('hotel.destroy')->middleware('rp:admin');
    Route::get('show/{hotel}', 'show')->name('hotel.show')->middleware('rp:user');
    Route::put('delete-picture/{hotel}', 'deletePicture')->name('hotels.delete-picture')->middleware('rp:admin');
});


// ========================== Order ==========================
Route::prefix('orders')->controller(OrderController::class)->name('order.')->group(function () {
    Route::get('', 'index')->name('index')->middleware('rp:admin');
    Route::post('add', 'add')->name('add');
    Route::post('delete/{order}', 'destroy')->name('destroy')->middleware('rp:admin');
    Route::put('status/{order}', 'setStatus')->name('status')->middleware('rp:admin');
    Route::get('show', 'showMyOrders')->name('show');
});
