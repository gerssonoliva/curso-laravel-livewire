<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PostController;
use App\Models\Post;

Route::get('/', function () {
  return view('admin.dashboard');
})->name('dashboard');

Route::resource('categories', CategoryController::class);
Route::resource('posts', PostController::class);

Route::get('/posts/{post}/download-image', function (Post $post) {
    return Storage::download($post->image_path);
})->name('posts.download-image');
?>