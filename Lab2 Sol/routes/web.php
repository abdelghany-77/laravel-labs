<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
  return redirect()->route('posts.index');
});

Route::resource('posts', PostController::class);

Route::post('posts/{post}/comments', [CommentController::class, 'store'])->name('posts.comments.store');
Route::put('posts/{post}/comments/{comment}', [CommentController::class, 'update'])->name('posts.comments.update');
Route::delete('posts/{post}/comments/{comment}', [CommentController::class, 'destroy'])->name('posts.comments.destroy');
