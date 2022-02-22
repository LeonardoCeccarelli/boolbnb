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

      // Take elements from db with ip_address and apartment_id same as passed in $request
      $already_exist = Visualisation::where('ip_address', $data[1])
                        ->where('apartment_id', $data[0])->first();

      // check if exist if the elements serched before exist
      if($already_exist){
        $existing_date = $already_exist->created_at->addHours(12);
        // check if the element found previously was added to the db less than 12h ago
        if($now < $existing_date){
          return [ "status" => "already added less than 12h ago"];
        }
      }

      $newVisualisation = new Visualisation();
      $newVisualisation->apartment_id = $data[0];
      $newVisualisation->ip_address = $data[1];

      $newVisualisation->save();

      return ["status" => "added successfully"];
    }
}
