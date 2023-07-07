<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\PortfolioController;
use App\Http\Controllers\Admin\BlogCategoryController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\FooterController;


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


        Route::get('/portfolio', [PortfolioController::class, 'index'])->name('portfolio');
        Route::get('/portfolio/create', [PortfolioController::class, 'create'])->name('portfolio-create');
        Route::post('/portfolio/store', [PortfolioController::class, 'store'])->name('portfolio-store');
        Route::get('/portfolio/edit/{id}', [PortfolioController::class, 'edit'])->name('portfolio-edit');
        Route::post('/portfolio/update', [PortfolioController::class, 'update'])->name('portfolio-update');
        Route::get('/portfolio/delete/{id}', [PortfolioController::class, 'delete'])->name('portfolio-delete');

        Route::get('/blog/category', [BlogCategoryController::class, 'index'])->name('blog-category');
        Route::get('/blog/category/create', [BlogCategoryController::class, 'create'])->name('blog-category-create');
        Route::post('/blog/category/store', [BlogCategoryController::class, 'store'])->name('blog-category-store');
        Route::get('/blog/category/edit/{id}', [BlogCategoryController::class, 'edit'])->name('blog-category-edit');
        Route::post('/blog/category/update', [BlogCategoryController::class, 'update'])->name('blog-category-update');
        Route::get('/blog/category/{id}', [BlogCategoryController::class, 'delete'])->name('blog-category-delete');

        Route::get('/blog', [BlogController::class, 'index'])->name('blog');
        Route::get('/blog/create', [BlogController::class, 'create'])->name('blog-create');
        Route::post('/blog/store', [BlogController::class, 'store'])->name('blog-store');
        Route::get('/blog/edit/{id}', [BlogController::class, 'edit'])->name('blog-edit');
        Route::post('/blog/update', [BlogController::class, 'update'])->name('blog-update');
        Route::get('/blog/{id}', [BlogController::class, 'delete'])->name('blog-delete');


        Route::get('/footer', [FooterController::class, 'index'])->name('footer');
        Route::post('update/footer', [FooterController::class, 'update'])->name('update-footer');

    });
});
