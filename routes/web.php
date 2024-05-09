<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->middleware(['auth', 'is_admin'])->group(function() {
    Route::get('dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index']);

    // Categories
    Route::controller(App\Http\Controllers\Admin\CategoryController::class)->group(function() {
        Route::get('/categories','index');
        Route::get('/category/create','create');
        Route::post('/category/create','store');
        Route::get('/category/{category}/edit','edit');
        Route::put('/category/{category}/edit','update');
    });

    Route::get('/brands' , App\Livewire\Admin\Brand\Index::class);


});
