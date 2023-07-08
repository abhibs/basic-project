<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\QueryController;
use App\Http\Controllers\ContactController;




Route::get('', [HomeController::class, 'index'])->name('home');
Route::post('queries', [QueryController::class, 'store'])->name('query-store');
Route::get('contact', [ContactController::class, 'create'])->name('contact-create');



