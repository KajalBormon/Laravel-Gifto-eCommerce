<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/* Route::get('/', function () {
    return view('welcome');
}); */

/* Route::get('/dashboard', function () {
    return view('home.index');
})->middleware(['auth', 'verified'])->name('dashboard'); */

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


//Home Controller 

Route::controller(HomeController::class)->group(function(){
    Route::get('admin/dashboard','index')
            ->middleware(['auth','admin'])
            ->name('admin.index');
    
    Route::get('/','home')->name('home');

    Route::get('/dashboard','home_login')
            ->middleware(['auth', 'verified'])
            ->name('dashboard');

    Route::get('product_details/{id}','product_details')->name('product_details');

    Route::get('add_cart/{id}','add_cart')
            ->middleware(['auth','verified'])
            ->name('add_cart');

    Route::get('mycart','mycart')->name('mycart');

    Route::get('cart_delete/{id}','cart_delete')->name('cart_delete');

    Route::post('cart_order','cart_order')->name('cart_order');

    Route::get('myorder','myorder')->name('myorder');

    Route::get('stripe/{value}', 'stripe');
    Route::post('stripe/{value}', 'stripePost')->name('stripe.post');
});



//Admin Controller Route

Route::middleware(['auth','admin'])->controller(AdminController::class)->group(function(){
    Route::get('view_category','view_category')->name('view_category');

    Route::post('add_category','add_category')->name('add_category');

    Route::get('delete_category/{id}','delete_category')->name('delete_category');

    Route::get('edit_category/{id}','edit_category')->name('edit_category');

    Route::post('update_category/{id}','update_category')->name('update_category');

    Route::get('add_product','add_product')->name('add_product');

    Route::post('upload_product','upload_product')->name('upload_product');

    Route::get('view_product','view_product')->name('view_product');

    Route::get('delete_product/{id}','delete_product')->name('delete_product');

    Route::get('edit_product/{id}','edit_product')->name('edit_product');

    Route::post('update_product/{id}','update_product')->name('update_product');

    Route::get('search','search')->name('search');
    
    Route::get('view_orders','view_orders')->name('view_orders');

    Route::get('on_the_way/{id}','on_the_way')->name('on_the_way');

    Route::get('delivered/{id}','delivered')->name('delivered');
    
    Route::get('print_pdf/{id}','print_pdf')->name('print_pdf');
});

/* Route::controller(HomeController::class)->group(function(){
    Route::get('stripe', 'stripe');
    Route::post('stripe', 'stripePost')->name('stripe.post');
}); */

