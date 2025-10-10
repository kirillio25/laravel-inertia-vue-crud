<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

//Route::get('/', [PostController::class, 'index'])->name('home');

Route::inertia('/', 'Home')->name('home');
Route::inertia('/about', 'About')->name('about');
