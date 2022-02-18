<?php

namespace App\Http\Controllers\Api;

use App\Apartment;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ApartmentController extends Controller
{
    public function getFiltered(Request $request)
    {
        $beds = $request->beds;
        $rooms = $request->rooms;
        $city = $request->city;
        $range = $request->range;
        $services = $request->services;

        $apartment = Apartment::with(["services", "user:id,name"]);

        if ($beds && $rooms && $city && $services) return $apartment->get();

        if ($beds) $apartment = $apartment->where("beds", $beds);
        if ($rooms) $apartment = $apartment->where("rooms", $rooms);
        if ($city) $apartment = $apartment->where("city", $city);

        if ($services) {
            $services = explode(",", $services);
            foreach ($services as $service) {
                $apartment->whereHas('services', function (Builder $query) use ($service) {
                    $query->where('services.name', $service);
                });
            }
        };

        return $apartment->get();
    }
}
