<?php

namespace App\Http\Controllers;

use App\Models\QuoteProducts;
use App\Models\Customers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
        // dd($request);

        for($i=0; $i < $request[$i]; $i++) {

            $quoteproducts = new QuoteProducts([

                'quote_id' => $request[$i]['quote_id'],
                'product_id' => $request[$i]['product_id'],
                'quantity' => $request[$i]['quantity']

            ]);
            $quoteproducts->save();
        }

        return response()->json("The Products have been successfully added");
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
