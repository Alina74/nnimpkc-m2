<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', [\App\Http\Controllers\NewsController::class, 'index'])->name('welcome');

Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/login', [UserController::class, 'loginPost']);

Route::get('/register',[UserController::class, 'register'])->name('register');
Route::post('/register',[UserController::class, 'registerPost']);

Route::middleware('auth')->group(function (){

    Route::middleware('role:user,admin,moder')->group(function(){

        Route::middleware('role:admin')->group(function (){
            Route::name('admin.')->group(function() {
                Route::prefix('/admin')->group(function (){
                    Route::resource('/users', UserController::class);
            });
            });
        });
        Route::resource('/news', \App\Http\Controllers\NewsController::class);
    });


    Route::get('/logout', [UserController::class, 'logout'])->name('logout');
});
