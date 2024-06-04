<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\Frontend\FrontendController::class, 'index']);
Route::get('/shop', App\Livewire\Frontend\Product\AllProduct::class);
Route::get('/collections', [App\Http\Controllers\Frontend\FrontendController::class, 'categories']);
Route::get('/collections/{category_slug}', [App\Http\Controllers\Frontend\FrontendController::class, 'prooducts']);
Route::get('/collections/{category_slug}/{product_slug}', [App\Http\Controllers\Frontend\FrontendController::class, 'prooductDetail']);
Route::get('/new-arrivals', [App\Http\Controllers\Frontend\FrontendController::class, 'newArrivals']);
Route::get('/featured-products', [App\Http\Controllers\Frontend\FrontendController::class, 'featuredProducts']);

Route::middleware(['auth'])->group(function() {
    Route::get('/wishlists', [App\Http\Controllers\Frontend\WishlistController::class, 'index']);
    Route::get('/carts', [App\Http\Controllers\Frontend\CartController::class, 'index']);
    Route::get('/checkout', [App\Http\Controllers\Frontend\CheckoutController::class, 'index']);
    Route::get('/my-orders', [App\Http\Controllers\Frontend\OrderController::class, 'index']);
    Route::get('/my-order/{order_id}', [App\Http\Controllers\Frontend\OrderController::class, 'show']);

});

Route::get('/thanks-order', [App\Http\Controllers\Frontend\CheckoutController::class, 'thanksOrder']);
Auth::routes();


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
        Route::get('/products/{product}/edit','edit')->name('products.edit');
        Route::put('/products/{product}/edit','update')->name('products.update');
        Route::get('/products/{product}/delete','destroy')->name('products.destroy');
        Route::get('/products/{image_id}/image/delete','destroyImage')->name('products.image.delete');

        Route::post('/products/product-color/{product_color_id}/update','updateQty')->name('products.product-color.update');
        Route::get('/products/product-color/{product_color_id}/delete','destroyProductColor')->name('products.product-color.delete');
    });
    // Colors
    Route::controller(App\Http\Controllers\Admin\ColorController::class)->group(function() {
        Route::get('/color','index')->name('color.index');
        Route::get('/color/create','create')->name('color.create');
        Route::post('/color/create','store')->name('color.store');
        Route::get('/color/{color}/edit','edit')->name('color.edit');
        Route::get('/color/{color}/delete','destroy')->name('color.destroy');
        Route::put('/color/{color}/edit','update')->name('color.update');
    });
    // Orders
    Route::controller(App\Http\Controllers\Admin\OrderController::class)->group(function() {
        Route::get('/orders','index')->name('order.index');
        Route::get('/order/{order_id}','show')->name('order.show');
        Route::put('/order/{order_id}','updateOrderStatus')->name('order.updateOrderStatus');

        Route::get('/invoice/{order_id}','viewInvoice')->name('invoice.viewInvoice');
        Route::get('/invoice/{order_id}/generate','generateInvoice')->name('invoice.generateInvoice');
    });

    Route::get('/brands' , App\Livewire\Admin\Brand\Index::class);


});
