<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\UserRoleController;
use App\Http\Controllers\Frontend\ArticleFrontController;
use App\Http\Controllers\Frontend\CategoryFrontController;
use App\Http\Controllers\Frontend\CommentFrontController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\HomeController;


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/articles/{article}', [ArticleFrontController::class, 'show'])->name('articles.show');
Route::get('/articles', [ArticleFrontController::class, 'index'])->name('articles.index');
Route::post('/articles/{article}/comments', [CommentFrontController::class, 'store'])->name('articles.comments.store');
Route::get('/categories/{category}', [CategoryFrontController::class, 'show'])->name('categories.show');
Route::get('/categories', [CategoryFrontController::class, 'index'])->name('categories.index');
Route::get('/contact', [ContactController::class, 'show'])->name('contact.show');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');


// Admin (grouped, middleware auth + is_admin+editor)
Route::prefix('admin')
    ->middleware(['auth', 'role:editor'])
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::post('/articles/{id}/toggle', [ArticleController::class, 'toggle'])->name('admin.articles.toggle');
        Route::resource('articles', ArticleController::class)->names('admin.articles');
        Route::resource('categories', CategoryController::class)->names('admin.categories');
        Route::get('comments', [CommentController::class, 'index'])->name('admin.comments.index');
        Route::post('comments/{comment}/approve', [CommentController::class, 'approve'])->name('admin.comments.approve');
        Route::delete('comments/{comment}', [CommentController::class, 'destroy'])->name('admin.comments.destroy');
        Route::post('articles/{article}/comments/toggle', [CommentController::class, 'toggleArticleComments'])->name('admin.articles.comments.toggle');
        Route::get('contact', [ContactMessageController::class, 'index'])->name('admin.contact.index');
        Route::post('contact/{id}/review', [ContactMessageController::class, 'markReviewed'])->name('admin.contact.review');
        Route::delete('contact/{id}', [ContactMessageController::class, 'destroy'])->name('admin.contact.destroy');
    });



Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/users', [UserRoleController::class, 'index'])->name('admin.users.index');
    Route::post('/admin/users/{user}/role', [UserRoleController::class, 'update'])->name('admin.users.updateRole');
});


require __DIR__ . '/auth.php';
