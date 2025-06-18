<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/movies/create', [MovieController::class, 'create'])->name('movies.create');
    Route::post('/movies', [MovieController::class, 'store'])->name('movies.store');
    Route::get('/movies/{movie:slug}/edit', [MovieController::class, 'edit'])->name('movies.edit');
    Route::put('/movies/{movie:slug}', [MovieController::class, 'update'])->name('movies.update');
    Route::delete('/movies/{movie:slug}', [MovieController::class, 'destroy'])->name('movies.destroy');

    Route::get('/myprofile', [UserController::class, 'myProfile'])->name('myprofile');
    Route::put('/myprofile', [UserController::class, 'updateProfile'])->name('profile.update');

    // Admin user management
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'updateProfile'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    Route::post('/logout', [UserController::class, 'logout'])->name('logout');
});

Route::get('/', function () {
    return redirect()->route('movies.index');
});
Route::get('/movies', [MovieController::class, 'index'])->name('movies.index');
Route::get('/movies/{movie:slug}', [MovieController::class, 'show'])->name('movies.show');

Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'RegisterForm'])->name('register.create');
    Route::post('/register', [AuthController::class, 'register'])->name('register.store');
    Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.store');
});







