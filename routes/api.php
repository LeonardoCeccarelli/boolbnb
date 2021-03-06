<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("/welcome/sponsored", "Api\ApartmentController@getSponsored");
Route::get("/search/apartment", "Api\ApartmentController@getFiltered");
Route::get("/apartment/{id}", "Api\ApartmentController@getSingle");
Route::get("/search/services", "Api\ServiceController@getAll");

// Visualisation routes
Route::post("/visualisation", "Api\VisualisationController@addToDb");
Route::get("/visualisation/statistics/{id}", "Api\VisualisationController@getVisualisationsData")->name("api.chart");

//  Messages routes
Route::post("/message", "Api\MessageController@onFormSubmit");
