<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MessageController;
use App\Http\Controllers\Admin\BookController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('messages',[MessageController::class, 'index']);
Route::POST('messages',[MessageController::class, 'store']);


// Route::prefox('admin/books')->group(function(){
//     Route::get('',[BookController::class,'index'])
//         ->name('book.index');
//     Route::get('{id}',[BookController::class,'show'])
//         ->whereNumber('id')
//         ->name('book.show');
// });


Route::prefix('admin/books')
    ->name('book.')
    ->controller(BookController::class)
    ->group(function(){
        Route::get('','index')->name('index');
        Route::get('{book}','show')
            ->whereNumber('book')->name('show');
        Route::get('create','create')->name('create');
        Route::post('','store')->name('store');
        Route::get('{book}/edit','edit')
            ->whereNumber('book')->name('edit');
        Route::put('{book}','update')
            ->whereNumber('book')->name('update');
        Route::delete('{book}','destroy')
            ->whereNumber('book')->name('destroy');
    });