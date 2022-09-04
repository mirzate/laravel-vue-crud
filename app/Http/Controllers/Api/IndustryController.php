<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Industry;
use App\Http\Resources\ContactResource;

class IndustryController extends Controller
{
    public function index()
    {
        $industries = Industry::all()->toArray();

        return $industries;      
    }
   
}