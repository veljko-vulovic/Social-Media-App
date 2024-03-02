<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', HomeController::class)
    // ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/user/{user}', [UserController::class, 'show'])->name('user.show');

    Route::post('/post', [PostController::class, 'store'])->name('post.store');
    Route::delete('/post', [PostController::class, 'destroy'])->name('post.destroy');

    Route::post('/like', [LikeController::class, 'store'])->name('like.store');
    Route::delete('/like', [LikeController::class, 'destroy'])->name('like.destroy');

    Route::post('/comment', [CommentController::class, 'store'])->name('comment.store');
    Route::delete('/comment', [CommentController::class, 'destroy'])->name('comment.destroy');

    Route::get('/followers', [FollowerController::class, 'index'])->name('follower.index');
    Route::post('/follower', [FollowerController::class, 'store'])->name('follower.store');
    Route::delete('/follower', [FollowerController::class, 'destroy'])->name('follower.destroy');

    Route::get('/group', [GroupController::class, 'index'])->name('group.index');
    Route::get('/group/{group}', [GroupController::class, 'show'])->name('group.show');
    Route::post('/group', [GroupController::class, 'store'])->name('group.store');
    Route::delete('/group', [GroupController::class, 'destroy'])->name('group.destroy');



    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
