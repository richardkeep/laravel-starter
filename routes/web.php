<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ManagerUserController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

Auth::routes(['register' => false]);

Route::get('/', [WelcomeController::class, 'index']);
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('admin/manage/user', [ManagerUserController::class, 'index'])->name('manage.user');
