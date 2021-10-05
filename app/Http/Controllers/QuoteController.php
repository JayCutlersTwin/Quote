<?php

namespace App\Http\Controllers;
namespace App\Mail;

use App\Models\Quote;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class QuoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Quote::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $quote = Quote::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $quote = new Quote([
            'customer_id' => request('customer_id'),
            'quotename' => request('quotename'),
            'productnames' => request('productnames')
        ]);
        $quote->save();

        return response()->json('The customer successfully added');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Quote  $quote
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $queryCustomer = DB::TABLE('quotes')
        ->join('customers', 'quotes.customer_id', '=', 'customers.id')
        ->select('quotes.id', 'quotes.customer_id', 'order_complete', 'customers.firstname', 'customers.lastname', 'customers.email', 'quotes.quotename')
        ->where('quotes.id', '=', $id)
        ->get();

        $queryQuoteProduct = DB::TABLE('quotes')
        ->join('quote_products', 'quotes.id', '=', 'quote_products.quote_id')
        ->join('products', 'quote_products.product_id', 'products.id')
        ->select('quote_products.id', 'products.productname', 'products.description', 'products.price', 'quote_products.quantity')
        ->where('quotes.id', '=', $id)
        ->get();

        return response()->json([
            'customer' => $queryCustomer,
            'quoteProduct' => $queryQuoteProduct,
    ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Quote  $quote
     * @return \Illuminate\Http\Response
     */
    public function edit(Quote $quote, $id)
    {
        $quote = Quote::findOrFail($id);
        return response()->json($quote);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Quote  $quote
     * @return \Illuminate\Http\Response
     */
    public function updateEdit(Request $request, $id)
    {
        // dd($request['order_complete'][0]);
        $quote = Quote::findOrFail($id);
        $quote->update($request->all());

        return response()->json('The quote has successfully updated');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Quote  $quote
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request['order_complete'][0]);
        $quote = Quote::findOrFail($id);
        $quote->update([
            'order_complete' => $request['order_complete'][0],
        ]);

        return response()->json('The quote has successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Quote  $quote
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $quote = Quote::findOrFail($id);
        $quote->delete();
        return response()->json('successfully deleted');
    }

    public function sendCustomerEmail(){
        $admin = "admin@admin.com";

        Mail::to($admin)
            ->send(new EmailQuote($quote));

    }
}
