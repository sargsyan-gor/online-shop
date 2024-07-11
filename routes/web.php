<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
Route::get('/', function () {
    return view('welcome');
});
Route::get('header', [AuthController::class, 'header'])->name('header');
Route::get('auth/register', [AuthController::class, 'signup'])->name('signup');
Route::post('auth/register', [AuthController::class, 'register'])->name('register');
Route::get('auth/login', [AuthController::class, 'login'])->name('login');
Route::post('auth/login', [AuthController::class, 'authentication'])->name('authentication');

Route::group(['middleware' => 'auth'], function () {
    Route::get('posts/main', [PostController::class, 'index'])->name('index');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('posts/createPost', [PostController::class, 'postPage'])->name('postPage');
    Route::post('posts/createPost', [PostController::class, 'createPost'])->name('createPost');
    Route::get('posts/{post}/post', [PostController::class, 'aboutPost'])->name('about');
});

Route::group(['middleware' => ['auth','admin']], function (){
    Route::get('auth/admin', [AuthController::class, 'adminPanel'])->name('adminPanel');
    Route::get('posts/{post}/editPost', [PostController::class, 'editPage'])->name('editPage');
    Route::put('posts/{id}/editPost', [PostController::class, 'editPost'])->name('editPost');
    Route::delete('delete/{post}', [PostController::class, 'deletePost'])->name('deletePost');
    Route::get('auth/{user}/editUser', [AuthController::class, 'editUserPage'])->name('editUserPage');
    Route::put('auth/{id}/editUser', [AuthController::class, 'editUser'])->name('editUser');
    Route::delete('auth/{user}/admin', [AuthController::class, 'deleteUser'])->name('deleteUser');
});
