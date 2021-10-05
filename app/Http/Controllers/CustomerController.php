<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Quote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Customer::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
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
        $customer = new Customer([
            'firstname' => $request->input('firstname'),
            'lastname' => $request->input('lastname'),
            'streetname' => $request->input('streetname'),
            'city' => $request->input('city'),
            'postcode' => $request->input('postcode'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone')
        ]);
        $customer->save();

        // $request->validate([
        //     'firstname' => 'required',
        //     'lastname' => 'required',
        //     'streetname' => 'required',
        //     'city' => 'required',
        //     'postcode' => 'required',
        //     'email' => ['required', 'regex:/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/', Rule::unique('companies', 'email')],
        //     'phone' => 'required'
        // ]);

        return response()->json('The customer successfully added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = Customer::findOrFail($id);

        $quote = DB::table('quotes')
        ->select('id','quotename', 'order_complete')
        ->where('customer_id', '=', $id)
        ->get();

        return response()->json([
            'customer' => $customer,
            'quotes' => $quote
        ],200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        return response()->json($customer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $customer = Customer::findOrFail($id);
        $customer->update($request->all());

        return response()->json('The book successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();
        return response()->json('successfully deleted');

    }
    // protected function validateCustomer(?Customer $customer = null): array
    // {
    //     $customer ??= new Customer();
    //
    //     return request()->validate([
    //         'firstname' => 'required',
    //         'lastname' => 'required',
    //         'streetname' => 'required',
    //         'city' => 'required',
    //         'postcode' => 'required',
    //         'email' => ['required', 'regex:/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/', Rule::unique('customers', 'email')->ignore($customer)],
    //         'phone' => 'required',
    //     ]);
    // }
}
