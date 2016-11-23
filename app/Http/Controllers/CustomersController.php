<?php

namespace App\Http\Controllers;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Rule;
use App\Customer;

class CustomersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::paginate(7);
        return view('Customers.Customers', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Customers.Create');
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
        'name' => 'required|max:255',
        'email' => 'required|email|max:255|unique:customers',
        'password' => 'required|min:6|confirmed',
        'address' => 'required',
        'city' => 'required',
        'phone' => 'required|min:11|unique:customers',
      ]);
        $input = $request->all();
        try {
          Customer::create($input);
          $customers = Customer::paginate(7);
          flash()->overlay('Customer Created Successfully', 'Good Work');
          return view('Customers.Customers', compact('customers'));
        } catch (\Exception $e) {
          flash()->error('Customer Added Error: '.$e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        return view('Customers.Edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $customer = Customer::findOrFail($id);
        if(isset($input['password'])){
           if($input['password'] == null || empty($input['password'])){
             $input['password'] = $customer->password;
           }
         } else {
           $input['password'] = $customer->password;
         }
        $this->validate($request, [
          'name' => 'required|max:255',
          'email' => 'required|email|max:255|unique:customers,email,'.$id,
          'password' => 'min:6|confirmed',
          'address' => 'required',
          'city' => 'required',
          'phone' => 'required|min:11|unique:customers,phone,'.$id,
        ]);

        try {
            $customer->update($input);
            flash()->overlay('Customer Updated Successfully', 'Good Work');
            $customers = Customer::paginate(7);
            return view('Customers.Customers', compact('customers'));
        } catch (\Exception $e) {
            flash()->error('Customer Updated Error: '.$e->getMessage());
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            Customer::findOrFail($id)->delete();
            flash()->overlay('Your Customer Deleted Successfully', 'Good Work');

        } catch(\Exception $e) {
            flash()->error('Customer Deleted Errors :'.$e->getMessage());
        }
        return redirect()->back();
    }
}
