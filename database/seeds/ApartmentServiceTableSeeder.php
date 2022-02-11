<?php

use App\Apartment;
use App\Service;
use Illuminate\Database\Seeder;

class ApartmentServiceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $apartments = Apartment::all();
        $services = Service::pluck("id");
        foreach ($apartments as $apartment) {
            $randomServiceNumber = rand(2, count($services));
            $shuffleServices = $services->shuffle();
            $apartmentService = $shuffleServices->slice(0, $randomServiceNumber);
            $apartment->services()->attach($apartmentService);
        }
    }
}
