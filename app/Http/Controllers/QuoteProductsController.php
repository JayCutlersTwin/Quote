<?php

namespace App\Http\Controllers;

use App\Models\QuoteProducts;
use Illuminate\Http\Request;

class QuoteProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return QuoteProducts::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $quoteproducts = new QuoteProducts([
            'quote_id' => request('quote_id'),
            'product_id' => request('product_id'),
            'quantity' => request('quantity')
        ]);
        $quoteproducts->save();

        return response()->json('The customer successfully added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\QuoteProducts  $quoteProducts
     * @return \Illuminate\Http\Response
     */
    public function show(QuoteProducts $quoteProducts)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\QuoteProducts  $quoteProducts
     * @return \Illuminate\Http\Response
     */
    public function edit(QuoteProducts $quoteProducts)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\QuoteProducts  $quoteProducts
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $quoteProducts = QuoteProducts::findOrFail($id);
        $quoteProducts->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\QuoteProducts  $quoteProducts
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $quoteProducts = QuoteProducts::findOrFail($id);
        $quoteProducts->delete();
        return response()->json('successfully deleted');
    }
}
