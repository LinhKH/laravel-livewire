<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->middleware(['auth', 'is_admin'])->group(function() {
    Route::get('dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index']);

    // Categories
    Route::controller(App\Http\Controllers\Admin\CategoryController::class)->group(function() {
        Route::get('/categories','index')->name('categories.index');
        Route::get('/categories/create','create')->name('categories.create');
        Route::post('/categories/create','store')->name('categories.store');
        Route::get('/categories/{category}/edit','edit')->name('categories.edit');
        Route::put('/categories/{category}/edit','update')->name('categories.update');
    });
    // Products
    Route::controller(App\Http\Controllers\Admin\ProductController::class)->group(function() {
        Route::get('/products','index')->name('products.index');
        Route::get('/products/create','create')->name('products.create');
        Route::post('/products/create','store')->name('products.store');
        // Route::get('/products/{product}/edit','edit');
        // Route::put('/products/{product}/edit','update');
    });

    Route::get('/brands' , App\Livewire\Admin\Brand\Index::class);


});
