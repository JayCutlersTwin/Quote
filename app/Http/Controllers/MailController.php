<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use App\Models\Product;
use App\Models\Customer;
use App\Mail\EmailQuote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function sendEmail($id){

        // $customerEmail = DB::TABLE('customers')
        // ->join('quotes', 'customers.id', '=', 'quotes.customer_id')
        // ->join('quote_products', 'quotes.customer_id', '=', 'customers.id')
        // ->select('quotes.id', 'quotes.customer_id', 'customers.firstname', 'customers.lastname', 'customers.email', 'quotes.quotename')
        // ->where('quotes.id', '=', $id)
        // ->get();
        //
        // Mail::to('random.emailConfirm', function(){
        //     $message->to($customerEmail);
        // });

        $queryCustomer = DB::TABLE('quotes')
        ->join('customers', 'quotes.customer_id', '=', 'customers.id')
        ->select('quotes.id', 'quotes.customer_id', 'customers.firstname', 'customers.lastname', 'customers.email', 'quotes.quotename')
        ->where('quotes.id', '=', $id)
        ->get();

        $customerEmail = DB::TABLE('quotes')
        ->join('customers', 'quotes.customer_id', '=', 'customers.id')
        ->select('customers.email')
        ->where('quotes.id', '=', $id)
        ->get();

        $queryQuoteProduct = DB::TABLE('quotes')
        ->join('quote_products', 'quotes.id', '=', 'quote_products.quote_id')
        ->join('products', 'quote_products.product_id', 'products.id')
        ->select('quote_products.id', 'products.productname', 'products.description', 'products.price', 'quote_products.quantity')
        ->where('quotes.id', '=', $id)
        ->get();

        Mail::to($customerEmail, function(){
           $message->send(new EmailQuote());
        });

    }
}
