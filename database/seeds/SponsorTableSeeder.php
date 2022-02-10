<?php

use App\Sponsor;
use Illuminate\Database\Seeder;

class SponsorTableSeeder extends Seeder
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
                "type" => "Basic",
                "price" => "2.99",
                "duration" => "24",
            ],
            [
                "type" => "Advanced",
                "price" => "5.99",
                "duration" => "72",
            ],
            [
                "type" => "Premium",
                "price" => "9.99",
                "duration" => "144",
            ]
            ];

            foreach ($data as $value) {
                $newValue = new Sponsor();

                $newValue->type = $value["type"];
                $newValue->price = $value["price"];
                $newValue->duration = $value["duration"];
                $newValue->save();
            }
    }
}
