<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\SupervisorsController;
use App\Http\Controllers\Supervisor\AuthController as SupervisorAuthController;
use App\Http\Controllers\Supervisor\CategoriesController;
use App\Http\Controllers\Supervisor\ProductsController;
use App\Http\Controllers\ThemeController;
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
// this route used to show login form
Route::get('',[ThemeController::class,'landing'])->name('landing');
Route::get('login',[ThemeController::class,'preview'])->middleware('guest:admin,supervisor')->name('login.preview');
Route::get('home',[ThemeController::class,'home'])->name('home');

Route::name('admin.')->prefix('admin')->group(function(){

    // Here all admin routes
    Route::name('auth.')->prefix('auth')->group(function(){

        // this route used to submit login form for admin
        Route::post('login',[AdminAuthController::class,'submit'])->name('login.submit');
        Route::get('logout',[AdminAuthController::class,'logout'])->name('logout');

    });
    Route::middleware('authCheck:admin')->group(function(){
        Route::name('supervisors.')->prefix('supervisors')->group(function(){

            // Here supervisors crud
            Route::get('',[SupervisorsController::class,'index'])->name('list');
            Route::get('view/{supervisor}',[SupervisorsController::class,'view'])->name('view');
            Route::get('add',[SupervisorsController::class,'add'])->name('add');
            Route::post('save',[SupervisorsController::class,'save'])->name('save');
            Route::post('update/{supervisor}',[SupervisorsController::class,'update'])->name('update');
            Route::post('delete',[SupervisorsController::class,'destroy'])->name('delete');
    
        });

    });

});

Route::name('supervisor.')->prefix('supervisor')->group(function(){

    // Here all supervisor routes
    Route::name('auth.')->prefix('auth')->group(function(){

        // this route used to submit login form for supervisor
        Route::post('login',[SupervisorAuthController::class,'submit'])->name('login.submit');
        Route::get('logout',[SupervisorAuthController::class,'logout'])->name('logout');

    });

    Route::middleware('authCheck:supervisor')->group(function(){

        Route::name('categories.')->prefix('categories')->group(function(){

            // Here categories crud
            Route::get('',[CategoriesController::class,'index'])->name('list');
            Route::get('view/{category}',[CategoriesController::class,'view'])->name('view');
            Route::get('add',[CategoriesController::class,'add'])->name('add');
            Route::post('save',[CategoriesController::class,'save'])->name('save');
            Route::post('update/{category}',[CategoriesController::class,'update'])->name('update');
            Route::post('delete',[CategoriesController::class,'destroy'])->name('delete');
    
        });
    
        Route::name('products.')->prefix('products')->group(function(){
    
            // Here products crud
            Route::get('',[ProductsController::class,'index'])->name('list');
            Route::get('view/{product}',[ProductsController::class,'view'])->name('view');
            Route::post('update/{product}',[ProductsController::class,'update'])->name('update');
            Route::get('add',[ProductsController::class,'add'])->name('add');
            Route::post('delete',[ProductsController::class,'destroy'])->name('delete');
            Route::post('imageUpload/{product}',[ProductsController::class,'imageUpload'])->name('imageUpload');
            Route::post('removeImageUpload/{product}',[ProductsController::class,'removeImageUpload'])->name('removeImageUpload');
    
        });

    });

});
