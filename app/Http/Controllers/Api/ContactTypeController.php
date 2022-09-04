<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactType;
use App\Http\Resources\ContactResource;

class ContactTypeController extends Controller
{
    public function index()
    {
        $contacts = ContactType::all()->toArray();

        return $contacts;      
    }
   
}