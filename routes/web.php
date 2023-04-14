<?php

use App\Http\Controllers\admin\AdminLoginCntroller;
use App\Http\Controllers\admin\AdminProductCntroller;
use App\Http\Controllers\admin\AdminUserCntroller;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
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
    return redirect()->route('login');
});

Route::post('login', [AdminLoginCntroller::class,'login'])->name('login');
Route::get('login', [AdminLoginCntroller::class,'index'])->name('login.perform');

Route::group(['middleware' => ['auth:web','isAdmin']], function () {
    Route::get('show', [AdminLoginCntroller::class,'index'])->name('show');
    Route::get('/logout', 'LogoutController@perform')->name('logout.perform');
    
    Route::get('/', HomeController::class)->name('home.index');
    Route::group(['prefix' => 'users'], function() {
        Route::get('/', [AdminUserCntroller::class,'index'])->name('users.index');
        Route::get('/create', [AdminUserCntroller::class,'create'])->name('users.create');
        Route::post('/create', [AdminUserCntroller::class,'store'])->name('users.store');
        Route::get('/{user}/show', [AdminUserCntroller::class,'show'])->name('users.show');
        Route::get('/{user}/edit', [AdminUserCntroller::class,'edit'])->name('users.edit');
        Route::patch('/{user}/update', [AdminUserCntroller::class,'update'])->name('users.update');
        Route::delete('/delete/{user}', [AdminUserCntroller::class,'destroy'])->name('users.destroy');
        Route::get('user_Product/{id}',[AdminProductCntroller::class,'user_Product'])->name('users.product');
    });

    Route::group(['prefix' => 'product'], function() {
        Route::get('/', [AdminProductCntroller::class,'index'])->name('products.index');
        Route::get('/create', [AdminProductCntroller::class,'create'])->name('products.create');
        Route::post('/create', [AdminProductCntroller::class,'store'])->name('products.store');
        Route::get('/{product}/show', [AdminProductCntroller::class,'show'])->name('products.show');
        Route::get('/{product}/edit', [AdminProductCntroller::class,'edit'])->name('products.edit');
        Route::patch('/{product}/update', [AdminProductCntroller::class,'update'])->name('products.update');
        Route::delete('/delete/{product}', [AdminProductCntroller::class,'destroy'])->name('products.destroy');
    });
});
