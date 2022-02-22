<?php

namespace App\Http\Controllers\Api;

use App\Apartment;
use App\Http\Controllers\Controller;
use App\Visualisation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use CyrildeWit\EloquentViewable;

class VisualisationController extends Controller
{
    public function addToDb(Request $request, Apartment $apartment)
    {

      $data = $request->all();
      $now = Carbon::now();

      // dd($request->all());

      $newVisualisation = new Visualisation();
      $newVisualisation->apartment_id = $data[0];
      $newVisualisation->ip_address = $data[1];

      $newVisualisation->save();

      return;

    }
}
