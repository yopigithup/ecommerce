<?php

use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Catalog;
use App\Livewire\Users;
use App\Livewire\Products;
use App\Livewire\Categories;
use App\Livewire\Customer;
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Cart;
use App\Livewire\Checkout;
use App\Models\Category;

/**
 * Laravel v10
 * Livewire v3
 * Tailwind CSS
 * Alpine JS
 */



// Public Routes
Route::get('/', Catalog\Index::class)->name('home'); //list of products
Route::get('/product/{product}', Catalog\show::class)->name('product.show'); // product details

Route::get('/cart', Cart::class)->name('cart.index');

Route::get('/checkout/{order}', Checkout::class)->name('checkout');




// Guest Routes
Route::middleware(['guest'])->group(function () {
    Route::get('register', Customer::class)->name('register');
    Route::get('login', Login::class)->name('login');
});

// Admin Routes

// Logout Route
Route::get('logout', function () {
    auth()->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');

// Protected Routes
Route::middleware('auth')->group(function () {
    Route::get('profiles', Users\Profile::class)->name('users.profile');
    Route::get('users', Users\Index::class)->name('users.index');

    // Category Management
    Route::get('categories', Categories\Index::class)->name('categories.index');
    Route::get('create-category', Categories\CreateCategory::class)->name('categories.store');
    Route::get('edit-category/{category}', Categories\EditCategory::class)->name('categories.update');

    // Product Management
    Route::get('products', Products\Index::class)->name('products.index');
    Route::get('create-product', Products\CreateProduct::class)->name('products.store');
    Route::get('edit-product/{product}', Products\EditProduct::class)->name('products.update');
    Route::get('products/{product}', Products\ShowProduct::class)->name('products.show');


    // Order Management
    // Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    // Route::get('/orders/table', [OrderController::class, 'showOrders'])->name('orders.table');

    // User Management
    Route::get('create-user', Users\CreateUser::class)->name('users.store');
    Route::get('edit-user/{user}', Users\EditUser::class)->name('users.update');
});
