<?php

use App\Http\Controllers\HomePageController;
use App\Http\Controllers\ProductDetailController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\SignInController;
use App\Http\Controllers\SignUpController;
use App\Http\Livewire\User\SignUpComponent;
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

Route::get('/signin', [SignInController::class, 'index']);
Route::post('/signin', [SignInController::class, 'postSignIn'])->name('user.post-sign-in');

Route::get('/signup', [SignUpController::class, 'index']);
Route::post('/signup', [SignUpController::class, 'postSignUp'])->name('user.post-sign-up');

Route::get('/reset-password', [ResetPasswordController::class, 'index']);
Route::post('/reset-password', [ResetPasswordController::class, 'postResetPassword'])->name('user.reset-password');

Route::get('/', [HomePageController::class, 'index']);

Route::get('/product-detail', [ProductDetailController::class, 'index']);

