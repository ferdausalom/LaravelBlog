<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);
Route::view('/about', 'front.about')->name('about');
Route::view('/contact', 'front.contact')->name('contact');

Route::get('/details/post/{slug}', [HomeController::class, 'show'])->name('details.post');
Route::get('/categories/{slug}', [HomeController::class, 'categoryPosts'])->name('categories.show');
Route::get('/authors/{slug}', [HomeController::class, 'authorPosts'])->name('authors.show');
Route::post('/posts/{post:slug}/comments', [CommentController::class, 'store'])->name('comment.store');
Route::post('/posts/{post:slug}/reply', [CommentController::class, 'replyStore'])->name('reply.store');

Route::middleware('admin')->group(function () {

    Route::name('admin.')->prefix('admin')->group(function () {
        Route::resources(
            [
                '' => PostController::class,
                '/posts' => PostController::class,
                '/categories' => CategoryController::class
            ],
            ['except' => ['show']]
        );
    });
});

require __DIR__ . '/auth.php';
