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
        $request->validate([
            'name' => 'required|string',
            'address' => 'string',
            'industry_id' => 'required|exists:App\Models\Industry,id',
            'city_id' => 'required|exists:App\Models\City,id'
        ]);

        $customer = new Customer([
            'name' => $request->input('name'),
            'address' => $request->input('address'),
            'industry_id' => $request->input('industry_id'),
            'city_id' => $request->input('city_id'),
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
            'address' => 'string',
            'industry_id' => 'required|exists:App\Models\Industry,id',
            'city_id' => 'required|exists:App\Models\City,id'
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