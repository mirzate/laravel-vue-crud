<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\City;
use App\Http\Resources\ContactResource;

class CityController extends Controller
{
    public function index()
    {
        $cities = City::with(['country'])->get()->toArray();

        return $cities;      
    }
   
}