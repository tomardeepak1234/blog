<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;

use App\Models\State;
use Illuminate\Support\Facades\Route;


// Register
Route::get('/register', [SignupController::class, 'register'])->name('register');
Route::post('/register', [SignupController::class, 'store'])->name('register.store');

// Login 
Route::get('/login', [LoginController::class, 'login'])->name('login'); 
Route::post('/login', [LoginController::class, 'loginCheck'])->name('login.check');  
Route::post('/logout', [LoginController::class, 'logout'])->name('logout'); 



// Roles (Admin Only)
Route::middleware('admin')->group(function () {
    Route::get('/role_master', [RoleController::class, 'index'])->name('roles.index');
    Route::post('/role_master/store', [RoleController::class, 'store'])->name('roles.store');
    Route::get('/role_master/edit/{id}', [RoleController::class, 'edit'])->name('roles.edit');
    Route::put('/role_master/update/{id}', [RoleController::class, 'update'])->name('roles.update');
    Route::delete('/role_master/delete/{id}', [RoleController::class, 'destroy'])->name('roles.destroy');

    // State (Admin Only)
    Route::get('/state_master', [StateController::class, 'index'])->name('states.index');
    Route::post('/state_master/store', [StateController::class, 'store'])->name('states.store');
    Route::get('/state_master/edit/{id}', [StateController::class, 'edit'])->name('states.edit');
    Route::put('/state_master/update/{id}', [StateController::class, 'update'])->name('states.update');
    Route::delete('/state_master/delete/{id}', [StateController::class, 'destroy'])->name('states.destroy');
   
    
    Route::get('/user/create', [SignupController::class, 'showform'])->name('user.register');
    Route::get('/user', [SignupController::class, 'listing'])->name('list');
    Route::get('/user/list', [SignupController::class, 'index'])->name('user.list');
    Route::post('/user', [SignupController::class, 'store'])->name('user.store');
    Route::get('/user/{id}/edit', [SignupController::class, 'edit'])->name('user.edit');
    Route::delete('/user/{id}', [SignupController::class, 'destroy'])->name('user.delete');
    Route::put('/user/{id}', [SignupController::class, 'update'])->name('user.update');
Route::get('/dashboard', [SignupController::class, 'dashboard'])->name('admin'); 

// Route::put('/profile/update',   [ProfileController::class, 'update'])->name('profile.update');
// Route::put('/profile/avatar',   [ProfileController::class, 'avatar'])->name('profile.avatar');
// Route::put('/profile/password', [ProfileController::class, 'password'])->name('profile.password');
// Route::delete('/profile',       [ProfileController::class, 'destroy'])->name('profile.destroy');

});



// Posts
Route::get('/post', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create'); 
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->name('posts.edit');
Route::put('/posts/{id}', [PostController::class, 'update'])->name('posts.update');
Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');
  Route::post('/post/{post}/like', [PostController::class, 'likePost'])->name('post.like');
    Route::post('/post/{post}/comment', [PostController::class, 'commentPost'])->name('post.comment');


    Route::get('/home',[PostController::class,'home'])->name('home');
    Route::get('my-posts',[PostController::class,'MyPost']);



