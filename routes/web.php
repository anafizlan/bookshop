<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\PurchaseController;
Route::get('/', function () {
    return view('welcome');
});

Route::post('/submit', [UserController::class, 'store']);
Route::get('/users', [UserController::class, 'index']);
Route::get('/delete/{id}', [UserController::class, 'delete']);
Route::get('/edit/{id}', [UserController::class, 'edit']);
Route::post('/update/{id}', [UserController::class, 'update']);
Route::get('/books', [BookController::class, 'recommend']);

Route::get('/purchase', [PurchaseController::class, 'index']);
Route::post('/buy/{id}', [PurchaseController::class, 'buy']);

Route::get('/checkout/{id}', [PurchaseController::class, 'checkout']);
Route::post('/payment/{id}', [PurchaseController::class, 'paymentSuccess']);