<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\AboutController;



Route::get('/test', function () {
    echo "Abhiram";
});

Route::group(['prefix' => 'admin'], function () {
    Route::get('/login', [AdminController::class, 'login'])->name('admin-login');
    Route::post('/login', [AdminController::class, 'loginPost'])->name('admin-login-post');

    Route::group(['middleware' => 'auth:admin'], function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin-dashboard');
        Route::get('/logout', [Admincontroller::class, 'adminLogout'])->name('admin-logout');
        Route::get('/profile', [Admincontroller::class, 'adminProfile'])->name('admin-profile');
        Route::get('/profile/edit', [Admincontroller::class, 'adminProfileEdit'])->name('admin-profile-edit');
        Route::post('/profile/update', [AdminController::class, 'adminProfileUpdate'])->name('admin-profile-update');
        Route::get('/change/password', [Admincontroller::class, 'changePassword'])->name('admin-change-password');
        Route::post('/update/password', [AdminController::class, 'updatePassword'])->name('admin-password-update');


        Route::get('/slider', [SliderController::class, 'index'])->name('slider');
        Route::post('update/slider', [SliderController::class, 'updateSlider'])->name('update-slider');


        Route::get('/about', [AboutController::class, 'index'])->name('about');
        Route::post('update/about', [AboutController::class, 'updateAbout'])->name('update-about');
        Route::get('/about/multiple/image/create', [AboutController::class, 'createMultiImage'])->name('multiple-image-create');
        Route::post('about/multiple/image/store', [AboutController::class, 'storeMultiImage'])->name('multiple-image-store');
        Route::get('/about/multiple/image/index', [AboutController::class, 'allMultiImage'])->name('multiple-image-index');
        Route::get('/about/multiple/image/edit/{id}', [AboutController::class, 'editMultiImage'])->name('multiple-image-edit');
        Route::post('/about/multiple/image/update', [AboutController::class, 'updateMultiImage'])->name('multiple-image-update');
        Route::get('/about/multiple/image/delete/{id}', [AboutController::class, 'deleteMultiImage'])->name('multiple-image-delete');

    });
});
