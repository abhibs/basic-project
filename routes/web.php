<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\QueryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\BlogController;







Route::get('', [HomeController::class, 'index'])->name('home');
Route::post('queries', [QueryController::class, 'store'])->name('query-store');
Route::get('contact', [ContactController::class, 'create'])->name('contact-create');
Route::post('contact/store', [ContactController::class, 'store'])->name('contact-store');
Route::get('about', [AboutController::class, 'about'])->name('home-about');
Route::get('portfolio', [PortfolioController::class, 'portfolio'])->name('home-portfolio');
Route::get('portfolio/detail/{id}', [PortfolioController::class, 'portfolioDetail'])->name('portfolio-detail');
Route::get('blog', [BlogController::class, 'blog'])->name('home-blog');
Route::get('blog/detail/{id}', [BlogController::class, 'blogDetail'])->name('blog-detail');
Route::get('category/blog/{id}', [BlogController::class, 'categoryBlog'])->name('category-blog');





