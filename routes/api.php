<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/

Route::middleware('api')->group(function () {
    Route::resource('countries', CountryController::class);
    Route::resource('customers', CustomerController::class);
    Route::resource('contacts', ContactController::class);
    Route::resource('contact-types', ContactTypeController::class)->only(['index']);
    Route::resource('cities', CityController::class)->only(['index']);
    Route::resource('industries', IndustryController::class)->only(['index']);
});
