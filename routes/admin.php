<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Livewire\Admin\BrandComponent;
use App\Http\Livewire\Admin\CreateProduct;
use App\Http\Livewire\Admin\DepartamentComponent;
use App\Http\Livewire\Admin\EditProduct;
use App\Http\Livewire\Admin\NewsComponent;
use App\Http\Livewire\Admin\ShowCategory;
use App\Http\Livewire\Admin\ShowDepartament;
use App\Http\Livewire\Admin\ShowProducts;
use App\Http\Livewire\Admin\UserComponent;
use App\Models\News;
use Illuminate\Support\Facades\Route;

Route::get('/', ShowProducts::class)->name('admin.index');

Route::get('products/create', CreateProduct::class)->name('admin.products.create');

Route::get('products/{product}/edit', EditProduct::class)->name('admin.products.edit');

Route::post('products/{product}/files', [ProductController::class, 'files'])->name('admin.products.files');

Route::get('categories', [CategoryController::class, 'index'])->name('admin.categories.index');

Route::get('categories/{category}', ShowCategory::class)->name('admin.categories.show');

Route::get('brands', BrandComponent::class)->name('admin.brands.index');

Route::get('orders', [OrderController::class, 'index'])->name('admin.orders.index');

Route::get('orders/{order}', [OrderController::class, 'show'])->name('admin.orders.show');

Route::get('departaments', DepartamentComponent::class)->name('admin.departaments.index');

Route::get('departaments/{department}', ShowDepartament::class)->name('admin.departaments.show');

Route::get('users', UserComponent::class)->name('admin.users.index');

Route::get('news', NewsComponent::class)->name('admin.news.index');