<?php

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
    return view('home');
});

Auth::routes([
    'register' => false, // Registration Routes...
    'reset' => false, // Password Reset Routes...
]);
Route::resource('voting', App\Http\Controllers\VotingController::class);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['middleware' => 'auth'], function () {
    Route::resource('pin', App\Http\Controllers\PinController::class);
    Route::get('/pin/{pin}/report', [App\Http\Controllers\PinController::class, 'report'])->name('pin.report');
    Route::get('/vote/{pin}', [App\Http\Controllers\VotingController::class, 'index'])->name('vote');
});
