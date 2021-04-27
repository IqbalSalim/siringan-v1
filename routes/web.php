<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HouseController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\CategoryController;
use App\Models\Room;
use Illuminate\Support\Facades\Route;

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
Route::resource('users', UserController::class);
Route::get('/products/trash', [App\Http\Controllers\ProductController::class, 'trash'])->name('products.trash');
Route::get('/products/{id}/restore', [ProductController::class, 'restore'])->name('products.restore');
Route::delete('/products/{product}/delete-permanent', [ProductController::class, 'deletePermanent'])->name('products.delete-permanent');
Route::resource('products', ProductController::class);
Route::get('/houses/{id}/estimated_product', [HouseController::class, 'estimated_product'])->name('houses.estimated_product');
Route::resource('houses', HouseController::class);
Route::get('/rooms/{id}/create_room', [RoomController::class, 'create_room'])->name('rooms.create_room');
Route::resource('rooms', RoomController::class);
Route::get('/ajax/categories/search', [CategoryController::class, 'ajaxSearch']);
Route::resource('categories', CategoryController::class);
