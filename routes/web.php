<?php

use App\Livewire\Home;
use App\Livewire\Users\CreateUser;
use App\Livewire\Users\EditUser;
use App\Livewire\Users\Index;
use Illuminate\Support\Facades\Route;

// TALL
/**
 * Laravel v10
 * Livewire v3
 * Tailwind css
 * Alpine JS
 */

Route::get('/', Home::class)->name('home');

Route::get('/users', Index::class)->name('users.index');

Route::get('/create-user', CreateUser::class)->name('create-user');

Route::get('/edit-user/{userId}', EditUser::class)->name('edit-user');
