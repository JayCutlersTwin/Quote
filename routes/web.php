<?php

use Illuminate\Support\Facades\Route;
use App\Mail\EmailQuote;
use App\Http\Controllers\QuoteController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Models\Quote;
use App\Models\Product;
use App\Models\Customer;
use App\Models\QuoteProducts;

Route::get('/quotes/send-email/{id}', function (Quote $quote, $id){

    $customerID = DB::table('quotes')
    ->join('customers', 'quotes.customer_id', 'customers.id')
    ->select('customer_id')
    ->where('quotes.id', '=', $id)
    ->get();

    $quote = DB::table('customers')
    ->join('quotes', 'customers.id', '=', 'quotes.customer_id')
    ->join('quote_products', 'quotes.id', '=', 'quote_products.quote_id')
    ->join('products', 'quote_products.product_id', '=', 'products.id')
    ->select('*')
    ->where('customers.id', '=', $customerID[0]->customer_id)
    ->where('quotes.id', '=', $id)
    ->get();

    $customerEmail = DB::table('customers')
    ->select('email')
    ->where('id', '=', $customerID[0]->customer_id)
    ->get();

    Mail::to($customerEmail)
        ->send(new EmailQuote($quote));
});

Route::get('/{any?}', function () {
    return view('app');
})->where('any', '.*');
