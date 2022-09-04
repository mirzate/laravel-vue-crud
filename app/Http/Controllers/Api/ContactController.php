<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Http\Resources\ContactResource;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::all();

        return ContactResource::collection($contacts);      
    }
    public function store(Request $request)
    {
        $request->validate([
            'value' => 'required|string',
            'customer_id' => 'required|exists:App\Models\Customer,id',
            'contact_type_id' => 'required|exists:App\Models\ContactType,id'
        ]);

        $contact = new Contact([
            'value' => $request->input('value'),
            'customer_id' => $request->input('customer_id'),
            'contact_type_id' => $request->input('contact_type_id'),
        ]);
        $contact->save();

        return response()->json('Contact created!');
    }
    public function show($id)
    {
        $contact = Contact::find($id);

        return response()->json($contact);
    }
    public function edit($id)
    {
        $contact = Contact::find($id);

        return response()->json($contact);
    }    
    public function update($id, Request $request)
    {

        $request->validate([
            'value' => 'required|string',
            'customer_id' => 'required|exists:App\Models\Customer,id',
            'contact_type_id' => 'required|exists:App\Models\ContactType,id'
        ]);

        $contact = Contact::find($id);
        $contact->update($request->all());

        return response()->json('Contact updated!');
    }
    public function destroy($id)
    {
        $contact = Contact::find($id);

        $contact->delete();
        
        return response()->json('Contact deleted!');
    }
}