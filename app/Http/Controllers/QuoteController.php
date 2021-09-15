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
        // $query = DB::TABLE('quotes')
        // ->join('products', 'quotes.product_id', '=', 'products.id')
        // ->join('customers', 'quotes.customer_id', '=', 'customers.id')
        // ->select('quotes.customer_id', 'customers.firstname', 'customers.lastname', 'customers.email',
        // 'quotes.quotename', 'products.id', 'products.productname', 'products.price', 'products.quantity')
        // ->where('quotes.id', '=', $id)
        // ->get();

        $queryCustomer = DB::TABLE('quotes')
        ->join('customers', 'quotes.customer_id', '=', 'customers.id')
        ->select('quotes.customer_id', 'customers.firstname', 'customers.lastname', 'customers.email', 'quotes.quotename')
        ->where('quotes.id', '=', $id)
        ->get();

        // $queryProduct = DB::TABLE('quotes')
        // ->join('products', 'quotes.productnames', '=', 'products.productname')
        // ->select('products.id', 'products.productname', 'products.price')
        // ->where('quotes.id', '=', $id)
        // ->get();

        $queryProduct = DB::TABLE('quotes')
        ->join('products', 'quotes.product_id', '=', 'products.id')
        ->select('products.id', 'quotes.productnames', 'products.price', 'products.description')
        ->where('quotes.id', '=', $id)
        ->get();

        return response()->json([
            'customer' => $queryCustomer,
            'products' => $queryProduct,
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
    public function update(Request $request, $id)
    {
        $quote = Quote::findOrFail($id);
        $quote->update($request->all());

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
