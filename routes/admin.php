<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;

Route::get('/test', function () {
    echo "Abhiram";
});

Route::group(['prefix' => 'admin'], function () {
    Route::get('/login', [AdminController::class, 'login'])->name('admin-login');
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin-dashboard');

    Route::group(['middleware' => 'auth:admin'], function () {

    });
});
