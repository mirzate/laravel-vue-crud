<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;

class CountryController extends Controller
{
    public function index()
    {
        $countries = Country::all()->toArray();

        return array_reverse($countries);      
    }
    public function store(Request $request)
    {
        $country = new Country([
            'name' => $request->input('name'),
        ]);
        $country->save();

        return response()->json('Country created!');
    }
    public function show($id)
    {
        $country = Country::find($id);

        return response()->json($country);
    }
    public function edit($id)
    {
        $country = Country::find($id);

        return response()->json($country);
    }    
    public function update($id, Request $request)
    {

        $request->validate([
            'name' => 'required|string',
        ]);

        $country = Country::find($id);
        $country->update($request->all());

        return response()->json('Country updated!');
    }
    public function destroy($id)
    {
        $country = Country::find($id);
        $country->delete();
        
        return response()->json('Country deleted!');
    }
}