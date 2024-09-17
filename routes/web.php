<?php

use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Home;
use App\Livewire\Users\CreateUser;
use App\Livewire\Users\EditUser;
use App\Livewire\Users;
use App\Livewire\Categories;
use App\Livewire\Products;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;


// TALL
/**
 * Laravel v10
 * Livewire v3
 * Tailwind css
 * Alpine JS
 */

Route::get('/', Home::class)->name('home');
Route::get('/home', Home::class)->name('home');

// Users will be redirected to this route if not logged in
// Volt::route(uri: '/login', 'login')->name('login');

Route::middleware(['guest'])->group(function () {
    Route::get("register", Register::class)->name('register');
    Route::get("login", Login::class)->name(name: 'login');
});

// Define the logout
Route::get('/logout', function () {
    auth()->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
});



// Protected routes
Route::middleware('auth')->group(function () {
    Route::get('/users', Users\Index::class)->name('users.index');

    //category
    Route::get('/categories', Categories\Index::class)->name('categories.index');
    Route::get('/create-category', action: Categories\CreateCategory::class)->name('categories.store');
    Route::get('/edit-category/{category}', Categories\EditCategory::class)->name('categories.update');

    //product
    Route::get('/products', Products\Index::class)->name('products.index');

    //user
    Route::get('/create-user', CreateUser::class)->name('users.store');
    Route::get('/edit-user/{user}', EditUser::class)->name('users.update');
});
