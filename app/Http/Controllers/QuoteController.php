<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quotes = DB::table('quotes')
        ->select('*')
        ->orderBy('quotes.updated_at', 'desc')
        ->get();

        return $quotes;
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
        $this->validate($request, [
            'customer_id' => 'required',
            'quotename' => 'required'
        ]);

        $quote = new Quote([
            'customer_id' => request('customer_id'),
            'quotename' => request('quotename'),
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

        $quote = Quote::findOrFail($id);

        $this->validate($request, [
            'quotename' => 'required'
        ]);

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
}
