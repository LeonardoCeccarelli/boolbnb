<?php

namespace App\Http\Controllers\Api;

use App\Apartment;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ApartmentController extends Controller
{
    public function getFiltered(Request $request)
    {
        $beds = $request->beds;
        $rooms = $request->rooms;
        $city = $request->city;
        $range = $request->range;
        $services = $request->services;

        $apartment = Apartment::with(["services", "user:id,name"])->where("visible", "like", 1);
        $basicApartment = $apartment->get();


        $lat = 42.3011;
        $lon = 12.3424;
        if (!$beds && !$rooms && !$city && !$services) {
            $sponsorApartment = $apartment->whereHas("sponsor", function ($query) {
                $query->where([
                    ["starting_date", "<", Carbon::now()],
                    ["end_date", ">", Carbon::now()]
                ]);
            })->get();
            return [$basicApartment, $sponsorApartment, $lat, $lon];
        };

        if ($beds) {
            $apartment = $apartment->where("beds", $beds);
        }
        if ($rooms) $apartment = $apartment->where("rooms", $rooms);

        if ($city) {
            // trovo coordinate città
            $baseUrl = 'https://api.tomtom.com/search/2/geocode/';
            $key = '74G2HVlLeNW6ZnVG4yzsaMj20OxuW1sJ';
            $endUrl = '.json?key=';
            $url = $baseUrl . $city . $endUrl . $key;
            $response = Http::get($url);
            $lat = $response->json()['results'][0]['position']['lat'];
            $lon = $response->json()['results'][0]['position']['lon'];

            // Filtro appartamento
            $apartment = $apartment->where("city", $city);
        }

        if ($services) {
            $services = explode(",", $services);
            foreach ($services as $service) {
                $apartment = $apartment->whereHas('services', function (Builder $query) use ($service) {
                    $query->where('services.name', $service);
                });
            }
        };
        $basicApartment = $apartment->get();
        $sponsorApartment = $apartment->whereHas("sponsor", function ($query) {
            $query->where([
                ["starting_date", "<", Carbon::now()],
                ["end_date", ">", Carbon::now()]
            ]);
        })->get();
        return [$basicApartment, $sponsorApartment, $lat, $lon];
    }
}
