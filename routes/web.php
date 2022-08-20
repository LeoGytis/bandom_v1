<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CountryController as Country;
use App\Http\Controllers\HotelController as Hotel;
use App\Http\Controllers\OrderController;

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

// ========================== Country ==========================
Route::group(['prefix' => 'countries'], function () {
    Route::get('', [Country::class, 'index'])->name('country.index')->middleware('rp:user');
    Route::get('create', [Country::class, 'create'])->name('country.create')->middleware('rp:admin');
    Route::post('store', [Country::class, 'store'])->name('country.store')->middleware('rp:admin');
    Route::get('edit/{country}', [Country::class, 'edit'])->name('country.edit')->middleware('rp:admin');
    Route::put('update/{country}', [Country::class, 'update'])->name('country.update')->middleware('rp:admin');
    Route::post('delete/{country}', [Country::class, 'destroy'])->name('country.destroy')->middleware('rp:admin');
    Route::get('show/{country}', [Country::class, 'show'])->name('country.show')->middleware('rp:user');
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
