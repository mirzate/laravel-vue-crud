<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Contact;
use App\Http\Resources\CustomerResource;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::all();

        return CustomerResource::collection($customers);      
    }
    public function store(Request $request)
    {
        $customer = new Customer([
            'name' => $request->input('name'),
        ]);
        $customer->save();

        return response()->json('Customer created!');
    }
    public function show($id)
    {
        $customer = Customer::find($id);

        return response()->json($customer);
    }
    public function edit($id)
    {
        $customer = Customer::find($id);

        return response()->json($customer);
    }    
    public function update($id, Request $request)
    {

        $request->validate([
            'name' => 'required|string',
        ]);

        $customer = Customer::find($id);
        $customer->update($request->all());

        return response()->json('Customer updated!');
    }
    public function destroy($id)
    {
        $customer = Customer::find($id);

        if(!empty($customer)){
            Contact::where('customer_id',$customer->id)->delete();
        }
        $customer->delete();
        
        return response()->json('Customer deleted!');
    }
}