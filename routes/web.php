<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\TransactionController;

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
    return redirect('login');
});

Route::get('login', function () {
    return view('login');
})->name('login')->middleware('guest');

Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('auth.google')->middleware('guest');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback'])->middleware('guest');
Route::get('logout', [GoogleController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');
Route::resource('transaction', TransactionController::class)->middleware('auth');
Route::get('transaction/{transaction}/attachment', [TransactionController::class, 'getImage'])->name('transaction.get-image')->middleware('auth');
Route::get('user', [UserController::class, 'index'])->middleware('is_admin');
Route::post('user/{user}/verify', [UserController::class, 'verify'])->name('user.verify')->middleware('is_admin');
Route::delete('user/{user}', [UserController::class, 'destroy'])->name('user.destroy')->middleware('is_admin');
