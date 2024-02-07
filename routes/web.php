<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommandeController;

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



Auth::routes();

Route::group(['middleware' => ['auth']], function() {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    
    // Article Routes
    Route::resource('articles', ArticleController::class);

    //Commande Routes
    Route::resource('commandes', CommandeController::class);

    //Cart Routes
    Route::resource('cart', CartController::class)->except(['index', 'store']);
    Route::get('/currentCart', [CartController::class, 'getCurrentCart']);
    Route::get('/cartItems', [CartController::class, 'getCartItems']);
    Route::get('/totalPrice/{cart}', [CartController::class, 'calculateTotalPrice']);
    Route::delete('/cart/{cart}/article/{article}', [CartController::class, 'removeCartArticle'])->name('cart.article.delete');
});
