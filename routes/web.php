<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/product',[ProductController::class, 'index']);

Route::get('/product/{id}/update',[ProductController::class, 'update']);

Route::get('/product/{id}/delete',[ProductController::class, 'delete']);


Route::get('/user/register',[UserController::class, 'register']);
Route::get('/user/signup',[UserController::class, 'signup'])->name('user.signup');

Route::post('/user/store', [UserController::class,'store'])->name('user.store');
Route::post('/user/login', [UserController::class,'login'])->name('user.login');
Route::get('/user/home', [UserController::class,'home'])->name('user.home')->middleware('login');
Route::get('/user/logout', [UserController::class,'logout'])->name('user.logout');
Route::get('/user/passwordform', [UserController::class,'passwordform'])->name('user.passwordform')->middleware('login');
Route::post('/user/resetpassword', [UserController::class,'resetpassword'])->name('user.resetpassword');