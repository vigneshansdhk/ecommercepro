<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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

Route::get('/',[HomeController::class,'index']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


Route::get('/redirect',[HomeController::class,'redirect']);

Route::get('/view-category',[AdminController::class,'view_category']);
Route::post('/add-category',[AdminController::class,'add_category']);
Route::get('/delete-category/{id}',[AdminController::class,'delete_category']);

Route::get('/create-product',[AdminController::class,'create_product']);
Route::post('/add-product',[AdminController::class,'add_product']);
Route::get('/show-product',[AdminController::class,'show_product']);
Route::get('/edit-product/{id}',[AdminController::class,'edit_product']);
Route::post('/update-product',[AdminController::class,'update_product']);
Route::get('/delete-product/{id}',[AdminController::class,'delete_product']);

Route::get('/product-details/{id}',[HomeController::class,'product_detail']);
Route::post('/add-cart',[HomeController::class,'addcart']);
Route::get('/show-cart',[HomeController::class,'show_cart']);
Route::get('/remove-cart/{id}',[HomeController::class,'remove_cart']);

Route::get('/cash-order',[HomeController::class,'cash_order']);









