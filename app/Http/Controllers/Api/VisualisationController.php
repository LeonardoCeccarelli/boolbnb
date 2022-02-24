<?php

namespace App\Http\Controllers\Api;

use App\Apartment;
use App\Http\Controllers\Controller;
use App\Visualisation;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VisualisationController extends Controller
{
    public function addToDb(Request $request)
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
      $newVisualisation->date = $now->toDateString();

      $newVisualisation->save();

      return ["status" => "added successfully"];
    }

    public function getVisualisationsData($id){
      
      // Take all the visualisations from the db
      $visualisations = Visualisation::where('apartment_id', $id)->get();

      // dd($visualisations);

      // dates to divide the visualisations
      // Last 7 days (by day)
      $today = Carbon::now()->toDateString();
      $yesterday = Carbon::yesterday()->toDateString();
      $threeDaysAgo = Carbon::now()->subDays(2)->toDateString();
      $fourDaysAgo = Carbon::now()->subDays(3)->toDateString();
      $fiveDaysAgo = Carbon::now()->subDays(4)->toDateString();
      $sixDaysAgo = Carbon::now()->subDays(5)->toDateString();
      $sevenDaysAgo = Carbon::now()->subDays(6)->toDateString();

      // Last year (per month)
      $currentYear = Carbon::today()->year;
      $lastYear = Carbon::createFromDate($currentYear-1)->year;

      $january = Carbon::createFromDate($currentYear, 1)->month;
      $february = Carbon::createFromDate($currentYear, 2)->month;
      $march = Carbon::createFromDate($currentYear, 3)->month;
      $april = Carbon::createFromDate($currentYear, 4)->month;
      $may = Carbon::createFromDate($currentYear, 5)->month;
      $june = Carbon::createFromDate($currentYear, 6)->month;
      $july = Carbon::createFromDate($currentYear, 7)->month;
      $august = Carbon::createFromDate($currentYear, 8)->month;
      $september = Carbon::createFromDate($currentYear, 9)->month;
      $october = Carbon::createFromDate($currentYear, 10)->month;
      $november = Carbon::createFromDate($currentYear, 11)->month;
      $december = Carbon::createFromDate($currentYear, 12)->month;

      $dailyViewsCount = [];
      $daysList = [];

      // if($visualisations){

        // To count the views per day
        $viewsCountToday = count($visualisations->where('date', $today));
        $viewsCountYesterday = count($visualisations->where('date', $yesterday));
        $viewsCountThreeDaysAgo = count($visualisations->where('date', $threeDaysAgo));
        $viewsCountFourDaysAgo = count($visualisations->where('date', $fourDaysAgo));
        $viewsCountFiveDaysAgo = count($visualisations->where('date', $fiveDaysAgo));
        $viewsCountSixDaysAgo = count($visualisations->where('date', $sixDaysAgo));
        $viewsCountSevenDaysAgo = count($visualisations->where('date', $sevenDaysAgo));

        // To put the days and views count into arrays
        array_push($dailyViewsCount, $viewsCountToday, $viewsCountYesterday, $viewsCountThreeDaysAgo, $viewsCountFourDaysAgo, $viewsCountFiveDaysAgo, $viewsCountSixDaysAgo, $viewsCountSevenDaysAgo);
        array_push($daysList,$today, $yesterday, $threeDaysAgo, $fourDaysAgo, $fiveDaysAgo, $sixDaysAgo, $sevenDaysAgo);
      // }
      

      return response()->json(compact('daysList', 'dailyViewsCount'));

    }
}
