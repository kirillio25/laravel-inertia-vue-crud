<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

//

Route::inertia('/', 'Home')->name('home');
//Route::inertia('/posts', 'Posts')->name('posts');
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
