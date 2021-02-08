<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();

Route::get('/',[App\Http\Controllers\HomeController::class, 'welcome']);
Route::prefix('dashboard')->middleware('auth')->group(function(){
    Route::get('/',[App\Http\Controllers\Users\DashboardController::class, 'index']);
    Route::prefix('users')->middleware('IsAdmin')->group(function(){
        Route::get('/',[App\Http\Controllers\Users\UsersController::class,'index'])->name('user_list');
        Route::get('/user_add',[App\Http\Controllers\Users\UsersController::class,'create'])->name('useradd');
        Route::post('/user_post',[App\Http\Controllers\Users\UsersController::class,'store'])->name('user_add');
        Route::post('/user_edit_post',[App\Http\Controllers\Users\UsersController::class,'update'])->name('user_edit_post');
        Route::get('/user_edit/{id}',[App\Http\Controllers\Users\UsersController::class,'edit']);
        Route::get('/user_delete/{id}',[App\Http\Controllers\Users\UsersController::class,'destroy']);
    });
    Route::prefix('books')->group(function(){
        Route::get('/',[App\Http\Controllers\BooksController::class,'index'])->name('books');
        Route::post('/addpost',[App\Http\Controllers\BooksController::class,'store'])->name("books_post");
        Route::get('/add',[App\Http\Controllers\BooksController::class,'create']);
        Route::get('/delete/{id}',[App\Http\Controllers\BooksController::class,'destroy']);
        Route::post('/update', [App\Http\Controllers\BooksController::class,'update'])->name('books_update');
        Route::get('/edit/{id}',[App\Http\Controllers\BooksController::class,'edit']);
    });
    Route::prefix('author')->group(function(){
        Route::get('/',[App\Http\Controllers\AuthorController::class,'index'])->name('author');
        Route::get('/add',[App\Http\Controllers\AuthorController::class,'create']);
        Route::post('/store',[App\Http\Controllers\AuthorController::class, 'store']);
        Route::get('/delete/{id}',[App\Http\Controllers\AuthorController::class,'destroy']);
        Route::get('/edit/{id}',[App\Http\Controllers\AuthorController::class,'edit']);
        Route::post('/update',[App\Http\Controllers\AuthorController::class,'update']);
    });
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
