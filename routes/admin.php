<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Models\Post;

Route::get('/', function () {
  return view('admin.dashboard');
})->name('dashboard');

Route::resource('categories', CategoryController::class);
Route::resource('posts', PostController::class);
Route::resource('permissions', PermissionController::class);
Route::resource('roles', RoleController::class);
Route::resource('users', UserController::class);

Route::get('/posts/{post}/download-image', function (Post $post) {
    return Storage::download($post->image_path);
})->name('posts.download-image');
?>