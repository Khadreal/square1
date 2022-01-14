<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;

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


/** Post related controllers */
Route::get('/', [ PostController::class, 'index' ])->name('home');

// Auth controller
Route::group(['middleware' => 'guest' ], function () {
    Route::get('login', [ AuthController::class, 'login'])->name('login');
    Route::post('login', [ AuthController::class, 'loginProcess'])->name('auth.login');
    Route::get('register', [ AuthController::class, 'register'] )->name('register');
    Route::post('register', [AuthController::class, 'registerProcess'])->name('auth.register');
});
//Non-guest route
Route::group( [ 'middleware' => 'auth' ], function() {
    Route::get('/auth/logout', [AuthController::class, 'logout'])->name('auth.logout');
    Route::get('posts',[PostController::class, 'myPosts'])->name('my.posts');
    Route::get('post-add',[PostController::class, 'add'])->name('post.add');
    Route::post('post-add',[PostController::class, 'store'])->name('post.store');
    Route::get('edit-post/{id}', [PostController::class, 'edit'])->name('post.edit');
    Route::post('edit-post/{id}', [PostController::class, 'update'])->name('post.update');

    //Admin user route
    Route::group(['middleware' => ['role:admin'], ], function(){
        Route::get('/admin', [AdminController::class, 'index'])->name('admin');
        Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
    });
});