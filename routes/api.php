<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\QuoteController;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Quote;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('customers', [CustomerController::class, 'index']);
Route::prefix('/customers')->group( function(){
    Route::get('/{id}', [CustomerController::class, 'show']);
    Route::post('/store', [CustomerController::class, 'store']);
    Route::get('/edit/{id}', [CustomerController::class, 'edit']);
    Route::post('/update/{id}', [CustomerController::class, 'update']);
    Route::delete('/delete/{id}', [CustomerController::class, 'destroy']);
});

Route::get('products', [ProductController::class, 'index']);
Route::prefix('/products')->group( function(){
    Route::post('/store', [ProductController::class, 'store']);
    Route::get('/edit/{id}', [ProductController::class, 'edit']);
    Route::post('/update/{id}', [ProductController::class, 'update']);
    Route::delete('/delete/{id}', [ProductController::class, 'destroy']);
});

Route::get('quotes', [QuoteController::class, 'index']);
Route::prefix('/quotes')->group( function(){
    Route::get('/{id}', [QuoteController::class, 'show']);
    Route::post('/store', [QuoteController::class, 'store']);
    Route::get('/create', [QuoteController::class, 'getCNP']);
    Route::get('/edit/{id}', [QuoteController::class, 'edit']);
    Route::post('/update/{id}', [QuoteController::class, 'update']);
    Route::delete('/delete/{id}', [QuoteController::class, 'destroy']);
});
