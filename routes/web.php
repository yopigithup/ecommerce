<?php

use App\Livewire\Home;
use App\Livewire\Users\CreateUser;
use App\Livewire\Users\EditUser;
use App\Livewire\Users;
use App\Livewire\Products;
use Illuminate\Support\Facades\Route;

// TALL
/**
 * Laravel v10
 * Livewire v3
 * Tailwind css
 * Alpine JS
 */

Route::get('/', Home::class)->name('home');

Route::get('/users', Users\Index::class)->name('users.index');
Route::get('/products', Products\Index::class)->name('products.index');

Route::get('/create-user', CreateUser::class)->name('users.store');

Route::get('/edit-user/{user}', EditUser::class)->name('users.update'); // route model binding
