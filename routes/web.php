<?php

use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Catalog;
use App\Livewire\Users;
use App\Livewire\Products;
use App\Livewire\Categories;
use App\Livewire\Customer;
use Illuminate\Support\Facades\Route;


// TALL
/**
 * Laravel v10
 * Livewire v3
 * Tailwind css
 * Alpine JS
 */

Route::get('/', Catalog\Index::class)->name('home');
// Route::get('home', Home::class)->name('home');

// Users will be redirected to this route if not logged in
// Volt::route(uri: '/login', 'login')->name('login');

Route::middleware(['guest'])->group(function () {
    Route::get("register", Customer::class)->name('register');
    Route::get("login", Login::class)->name('login');
});

// Define the logout
Route::get('logout', function () {
    auth()->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');

Route::get('product/{product}', Catalog\Show::class)->name('product.show');

// Protected routes
Route::middleware('auth')->group(function () {
    Route::get('profiles', Users\Profile::class)->name('users.profile');
    Route::get('users', Users\Index::class)->name('users.index');

    //category
    Route::get('categories', Categories\Index::class)->name('categories.index');
    Route::get('create-category', action: Categories\CreateCategory::class)->name('categories.store');
    Route::get('edit-category/{category}', Categories\EditCategory::class)->name('categories.update');
    Route::get('edit-product/{product}', Products\EditProduct::class)->name('products.update');

    //product
    Route::get('products', Products\Index::class)->name('products.index');
    Route::get('create-product', Products\CreateProduct::class)->name('products.store');
    Route::get('edit-product/{product}', Products\EditProduct::class)->name('products.update');
    Route::get('products/{product}', Products\ShowProduct::class)->name('products.show');

    //user
    Route::get('create-user', Users\CreateUser::class)->name('users.store');
    Route::get('edit-user/{user}', Users\EditUser::class)->name('users.update');
});
