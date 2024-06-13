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

Route::get('/', [App\Http\Controllers\WelcomeController::class, 'index'])->name('root');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/* 사용자 등록 */
Route::get('auth/register', [App\Http\Controllers\UsersController::class, 'create'])->name('users.create');
Route::post('auth/register', [App\Http\Controllers\UsersController::class, 'store'])->name('users.store');

