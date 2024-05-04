<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomeController;
use App\Http\Livewire\CreateOrder;
use App\Http\Livewire\ShoppingCart;
use App\Http\Controllers\WebhooksController;
use App\Http\Livewire\Global\FrequentlyQuestions;
use App\Http\Livewire\PaymentOrder;
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

Route::get('/', WelcomeController::class);

Route::get('search', SearchController::class)->name('search');
Route::get('categories/{category}', [CategoryController::class, 'show'])->name('categories.show');
Route::get('products/{product}', [ProductController::class, 'show'])->name('products.show');
Route::get('cart', ShoppingCart::class)->name('cart');
Route::get('frequently-asked-questions', FrequentlyQuestions::class)->name('global.frequently');

// Route::resource('users','UsersController')->names('users');
Route::get('registro', [UserController::class, 'registro'])->name('registro');
Route::post('registro', [UserController::class, 'store'])->name('store');

Route::middleware(['auth'])->group(function() {
    
    Route::get('orders/create', CreateOrder::class)->name('orders.create');
    Route::get('orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::get('orders', [OrderController::class, 'index'])->name('orders.index');
    // Route::get('orders/{order}/payment', [OrderController::class, 'payment'])->name('orders.payment');

    Route::get('orders/{order}/payment', PaymentOrder::class)->name('orders.payment');

    Route::get('orders/{order}/pay', [OrderController::class, 'pay'])->name('orders.pay');
});

Route::post('webhooks', WebhooksController::class);

Route::post('reviews/{product}', [ReviewController::class, 'store'])->name('reviews.store');
