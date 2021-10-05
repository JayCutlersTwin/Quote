<?php

use Illuminate\Support\Facades\Route;
use App\Mail\EmailQuote;
use App\Http\Controllers\QuoteController;
use Illuminate\Support\Facades\Mail;
use App\Models\Quote;
use App\Models\Product;
use App\Models\Customer;


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

Route::get('/quotes/send-email', function (Quote $quote, Product $product, Customer $customer){
    $admin = "admin@admin.com";

    $quote = Quote::all();
    $product = Product::all();
    $customer = Customer::all();

    Mail::to($admin)
        ->send(new EmailQuote($quote, $product, $customer));
});

Route::get('/{any?}', function () {
    return view('app');
})->where('any', '.*');
