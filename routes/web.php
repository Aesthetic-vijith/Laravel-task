<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
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
    return view('welcome');
});

Route::post('/check-email', [CustomerController::class, 'check_email'])->name('check.email');
Route::post('/check-phone', [CustomerController::class, 'check_phone'])->name('check.phone');
Route::post('customer/store', [CustomerController::class,'store'])->name('store.customer');


