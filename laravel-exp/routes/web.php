<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\ProductController;

Route::get('/', function () {
    return view('welcome');
});

    Route::prefix('admin/customer')
        ->name('customer.')
        ->controller(CustomerController::class)
        ->group(function(){
            Route::get('','customer')->name('customer');
            Route::post('','store');
            Route::delete('','destroy')->name('destroy');
            Route::put('{id}','update')->name('update');
        });

// Route::get('admin/customer',[CustomerController::class,'customer'])->name('customer.customer');
// Route::post('admin/customer',[CustomerController::class,'store']);
// Route::delete('admin/customer',[CustomerController::class,'destroy']);
Route::get('admin/nogel', [CustomerController::class, 'noGelpen']);
Route::get('admin/gelpen', [CustomerController::class, 'gelpen']);
Route::get('admin/product',[ProductController::class,'product']);
Route::get('admin/noguri',[ProductController::class,'nogurintekku']);

