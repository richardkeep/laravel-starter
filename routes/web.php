<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ManageUserController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

Auth::routes(['register' => false]);

Route::get('/', [WelcomeController::class, 'index']);
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['role:super_admin|admin']], function () {
    Route::get('admin/manage/users', [ManageUserController::class, 'index'])->name('manage.user');
    Route::get('admin/manage/user/view/{user}', [ManageUserController::class, 'view'])->name('manage.user.view');
    Route::get('admin/manage/user/add', [ManageUserController::class, 'add'])->name('manage.user.add');
    Route::post('admin/manage/user/add', [ManageUserController::class, 'store'])->name('manage.user.save');
});
