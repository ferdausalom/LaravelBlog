<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);
Route::get('/about', fn () => view('front.about'))->name('about');
Route::get('/contact', fn () => view('front.contact'))->name('contact');

Route::get('/details/post/{slug}', [HomeController::class, 'show'])->name('details.post');
Route::get('/categories/{slug}', [HomeController::class, 'categoriesIndex'])->name('categories.show');
Route::get('/authors/{slug}', [HomeController::class, 'authorsIndex'])->name('authors.show');
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

Route::get('/symlink', function () {
    Artisan::call('storage:link');
});

require __DIR__ . '/auth.php';
