<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function sendEmail($id){

        $customerEmail = DB::TABLE('customers')
        ->select('customers.email')
        ->where('quotes.id', '=', $id)
        ->get();

        Mail::send('random.emailConfirm', function(){
            $message->to($customerEmail);
        });
    }
}
