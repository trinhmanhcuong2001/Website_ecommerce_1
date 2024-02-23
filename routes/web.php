<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Users\LoginController;
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\UploadController;
use App\Http\Controllers\HomeController;



Route::get('admin/users/login',[LoginController::class,'index'])->name('login');
Route::post('admin/users/login/store',[LoginController::class, 'store']);

Route::middleware(['auth'])->group(function(){
    Route::prefix('admin')->group(function(){
        Route::get('main',[MainController::class, 'index']);
        #Menu
        Route::prefix('menu')->group(function(){
            Route::get('add', [MenuController::class, 'create']);
            Route::post('add', [MenuController::class, 'store']);
            Route::get('list', [MenuController::class, 'index']);
            Route::get('edit/{menu}', [MenuController::class, 'show']);
            Route::post('edit/{menu}', [MenuController::class, 'update']);
            Route::DELETE('delete', [MenuController::class, 'delete']);
        });
        #Product
        Route::prefix('product')->group(function (){
            Route::get('add',[ProductController::class, 'create']);
            Route::post('add',[ProductController::class, 'store']);
            Route::get('list',[ProductController::class, 'index']);
            Route::get('edit/{product}',[ProductController::class, 'show']);
            Route::post('edit/{product}',[ProductController::class, 'update']);
            Route::DELETE('delete', [ProductController::class, 'delete']);
        });
        #Slider
        Route::prefix('slider')->group(function (){
            Route::get('add',[SliderController::class, 'create']);
            Route::post('add',[SliderController::class, 'store']);
            Route::get('list',[SliderController::class, 'index']);
            Route::get('edit/{slider}',[SliderController::class, 'show']);
            Route::post('edit/{slider}',[SliderController::class, 'update']);
            Route::DELETE('delete', [SliderController::class, 'delete']);
        });

        #Upload
        Route::post('upload/services',[UploadController::class, 'store'])->name('admin.upload');

        #Cart
        Route::get('/customers', [App\Http\Controllers\Admin\CartController::class, 'index']);
        Route::get('/customers/view/{customer}', [App\Http\Controllers\Admin\CartController::class, 'show']);
    });
    
});

Route::get('/', [HomeController::class, 'index']);
Route::post('services/load-product', [HomeController::class, 'loadProduct']);
Route::post('services/show-product-details', [HomeController::class, 'showProductDetails']);
Route::get('/danh-muc/{id}-{slug}.html', [App\Http\Controllers\MenuController::class, 'index']);
Route::get('/san-pham/{id}-{slug}.html', [App\Http\Controllers\ProductController::class, 'index']);
Route::post('/add-cart', [App\Http\Controllers\CartController::class, 'index']);
Route::get('/carts', [App\Http\Controllers\CartController::class, 'show']);
Route::post('/update-cart', [App\Http\Controllers\CartController::class, 'update']);
Route::get('/carts/delete/{id}', [App\Http\Controllers\CartController::class, 'delete']);
Route::post('/carts', [App\Http\Controllers\CartController::class, 'addCart']);
Route::get('/add-comment', [App\Http\Controllers\CommentController::class, 'addComment']);
Route::get('/load-comment', [App\Http\Controllers\CommentController::class, 'loadComment']);
