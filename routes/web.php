<?php

use App\Http\Controllers\ListController;
use App\Http\Controllers\Auth\ForgotPassController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPassController;
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

//Main
Route::get('/index/upload', [ListController::class, 'uploadPage'])->middleware('security');
Route::post('/index/upload', [ListController::class, 'upload']);

Route::get('/index', [ListController::class, 'list'])->middleware('security')->where('locale', 'en|id')->name('index');

Route::get('/index/edit/{id}', [ListController::class, 'editPage']);
Route::post('/index/edit/{id}', [ListController::class, 'update']);

Route::delete('/index/delete/{id}', [ListController::class, 'delete']);

//Login
Route::get('/login', [LoginController::class, 'loginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/forgot-password', [ForgotPassController::class, 'requestPassword'])->name('password.request');
Route::post('/forgot-password', [ForgotPassController::class, 'sendEmail'])->name('password.email');

Route::get('/reset-password/{token}', [ResetPassController::class, 'resetForm'])->name('password.reset');
Route::post('/reset-password', [ResetPassController::class, 'reset'])->name('password.update');

Route::get('/register', [RegisterController::class, 'registerForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
