<?php

use App\Service;
use Illuminate\Database\Seeder;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                "name" => "Wi-fi",
                "icon" => '<i class="far fa-wifi"></i>',
            ],
            [
                "name" => "Posto Macchina",
                "icon" => '<i class="far fa-car"></i>',
            ],
            [
                "name" => "Piscina",
                "icon" => '<i class="far fa-swimmer"></i>',
            ],
            [
                "name" => "Portineria",
                "icon" => '<i class="fas fa-concierge-bell"></i>',
            ],
            [
                "name" => "Cucina",
                "icon" => '<i class="far fa-oven"></i>',
            ],
            [
                "name" => "Sauna",
                "icon" => '<i class="far fa-hot-tub"></i>',
            ],
            [
                "name" => "Vista mare",
                "icon" => '<i class="far fa-umbrella-beach"></i>',
            ],
            [
                "name" => "Palestra",
                "icon" => '<i class="far fa-dumbbell"></i>',
            ],
            [
                "name" => "Aria condizionata",
                "icon" => '<i class="far fa-air-conditioner"></i>',
            ],
            [
                "name" => "TV",
                "icon" => '<i class="far fa-tv"></i>',
            ],
        ];

        foreach ($data as $value) {
            $newValue = new Service();

            $newValue->name = $value["name"];
            $newValue->icon = $value["icon"];

            $newValue->save();
        }
    }
}
