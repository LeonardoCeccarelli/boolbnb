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

    public function getSingle($id)
    {
        $data = Apartment::where("id", $id)->with(["services", "user:id,name"])->first();
        $data["cover_img"] = url("storage/" . $data["cover_img"]);
        return $data;
    }

    public function getSponsored()
    {
        $data = Apartment::with(["services"])
            ->where("visible", 1)
            ->whereHas("sponsor", function ($query) {
                $query->whereDate("end_date", ">", Carbon::now()->toDateString());
            })->limit(8)->orderBy("updated_at", "DESC")->get();

        foreach ($data as $apartment) {
            $apartment['cover_img'] = url("storage/" . $apartment['cover_img']);
        }
        return $data;
    }

    public function getFiltered(Request $request)
    {
        $beds = $request->beds;
        $rooms = $request->rooms;
        $city = $request->city;
        $range = $request->range;
        if ($range < 1 || $range > 35) $range = 20;
        $services = $request->services;

        $apartment = Apartment::with(["services", "user:id,name"])->where("visible", 1)->orderBy("updated_at", "DESC");
        $basicApartment = $apartment->get();


        $lat = 42.3011;
        $lon = 12.3424;
        if (!$beds && !$rooms && !$city && !$services) {
            $sponsorApartment = $apartment->whereHas("sponsor", function ($query) {
                $query->whereDate("end_date", ">", Carbon::now()->toDateString());
            })->get();

            foreach ($basicApartment as $apartment) {
                $apartment['cover_img'] = url("storage/" . $apartment['cover_img']);
            }

            foreach ($sponsorApartment as $apartment) {
                $apartment['cover_img'] = url("storage/" . $apartment['cover_img']);
            }

            return [$basicApartment, $sponsorApartment, $lat, $lon];
        };

        if ($beds) {
            $apartment = $apartment->where("beds", $beds);
        }
        if ($rooms) $apartment = $apartment->where("rooms", $rooms);

        if ($city) {
            // trovo coordinate citt??
            $baseUrl = 'https://api.tomtom.com/search/2/geocode/';
            $key = '74G2HVlLeNW6ZnVG4yzsaMj20OxuW1sJ';
            $endUrl = '.json?key=';
            $url = $baseUrl . $city . $endUrl . $key;
            $response = Http::get($url);
            if ($response->json()['results']) {
                $lat = $response->json()['results'][0]['position']['lat'];
                $lon = $response->json()['results'][0]['position']['lon'];
            }

            // Calcolo l'area di ricerca convertendi i km in gradi
            $R = 6371;
            $maxLat = $lat + rad2deg($range / $R);
            $minLat = $lat - rad2deg($range / $R);
            $maxLon = $lon + rad2deg(asin($range / $R) / cos(deg2rad($lat)));
            $minLon = $lon - rad2deg(asin($range / $R) / cos(deg2rad($lat)));

            // Filtro appartamento
            $apartment = $apartment->where("city", $city);
            $apartment = $apartment->whereBetween("lat", [$minLat, $maxLat]);
            $apartment = $apartment->whereBetween("lon", [$minLon, $maxLon]);
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

        foreach ($basicApartment as $apartment) {
            $apartment['cover_img'] = url("storage/" . $apartment['cover_img']);
        }

        foreach ($sponsorApartment as $apartment) {
            $apartment['cover_img'] = url("storage/" . $apartment['cover_img']);
        }
        return [$basicApartment, $sponsorApartment, $lat, $lon];
    }
}
