<?php

use App\Apartment;
use Illuminate\Database\Seeder;

class ApartmentsTableSeeder extends Seeder
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
                "title" => "Appartamento centro Roma",
                "description" => "appartamento situato a 200 dai musei vaticani",
                "cover_img" => null,
                "rooms" => 4,
                "beds" => 6,
                "bathrooms" => 2,
                "square_metres" => 100,
                "night_price" => 25.00,
                "address" => "Via Germanico 7",
                "city" => "Roma",
                "lat" => "41.90807",
                "lon" => "12.45599",
                "visible" => true,
                "user_id" => 6,
            ],
            [
                "title" => "Appartamento colosseo",
                "description" => "appartamento a 2 passi dal centro di Roma",
                "cover_img" => null,
                "rooms" => 3,
                "beds" => 4,
                "bathrooms" => 1,
                "square_metres" => 83,
                "night_price" => 84.00,
                "address" => "Via Cavour 294",
                "city" => "Roma",
                "lat" => "41.89358",
                "lon" => "12.48945",
                "visible" => true,
                "user_id" => 6,
            ],
            [
                "title" => "Appartamento Duomo",
                "description" => "appartamento in centro a Milano",
                "cover_img" => null,
                "rooms" => 5,
                "beds" => 4,
                "bathrooms" => 1,
                "square_metres" => 95,
                "night_price" => 112.00,
                "address" => "Via Ugo Foscolo 1",
                "city" => "Milano",
                "lat" => "45.55985",
                "lon" => "8.77196",
                "visible" => true,
                "user_id" => 7,
            ],
            [
                "title" => "Appartamento Rho Fiera",
                "description" => "appartamento bellissimo zona rho fiera",
                "cover_img" => null,
                "rooms" => 6,
                "beds" => 5,
                "bathrooms" => 2,
                "square_metres" => 130,
                "night_price" => 198.00,
                "address" => "Viale Risorgimento 84",
                "city" => "Milano",
                "lat" => "45.43124",
                "lon" => "9.35263",
                "visible" => true,
                "user_id" => 7,
            ],
            [
                "title" => "Attico al centro di firenze",
                "description" => "appartamento di prestigio vicino al centro",
                "cover_img" => null,
                "rooms" => 8,
                "beds" => 6,
                "bathrooms" => 2,
                "square_metres" => 185,
                "night_price" => 570.00,
                "address" => "Via della Stufa 9",
                "city" => "Firenze",
                "lat" => "43.7759",
                "lon" => "11.25478",
                "visible" => true,
                "user_id" => 8,
            ],
            [
                "title" => "Bilocale situato in zona tranquilla",
                "description" => "bilocale zona centrale della città",
                "cover_img" => null,
                "rooms" => 3,
                "beds" => 2,
                "bathrooms" => 1,
                "square_metres" => 64,
                "night_price" => 98.00,
                "address" => "Via Lungarno Corsini 5",
                "city" => "Firenze",
                "lat" => "43.77014",
                "lon" => "11.24925",
                "visible" => true,
                "user_id" => 8,
            ],
            [
                "title" => "Monolocale",
                "description" => "Monolocale situato a 300 metri dal politecnico, adatto per studenti",
                "cover_img" => null,
                "rooms" => 2,
                "beds" => 1,
                "bathrooms" => 1,
                "square_metres" => 43,
                "night_price" => 68.00,
                "address" => "Via Pigafetta 31",
                "city" => "Torino",
                "lat" => "45.05802",
                "lon" => "7.65831",
                "visible" => true,
                "user_id" => 9,
            ],
            [
                "title" => "Attico spazioso in zona tranquilla",
                "description" => "Attico situato in quartiere san salvario",
                "cover_img" => null,
                "rooms" => 7,
                "beds" => 4,
                "bathrooms" => 2,
                "square_metres" => 156,
                "night_price" => 289.00,
                "address" => "Via Ormea 21",
                "city" => "Torino",
                "lat" => "45.05735",
                "lon" => "7.68438",
                "visible" => true,
                "user_id" => 9,
            ],
            [
                "title" => "Appartamento vista mare",
                "description" => "Appartamento a due passi da piazza plebiscito",
                "cover_img" => null,
                "rooms" => 5,
                "beds" => 2,
                "bathrooms" => 2,
                "square_metres" => 102,
                "night_price" => 175.00,
                "address" => "Vico Solitaria 29",
                "city" => "Napoli",
                "lat" => "40.83377",
                "lon" => "14.24803",
                "visible" => true,
                "user_id" => 10,
            ],
            [
                "title" => "Bilocale vista vesuvio",
                "description" => "Bilocale situato in zona centro",
                "cover_img" => null,
                "rooms" => 3,
                "beds" => 2,
                "bathrooms" => 1,
                "square_metres" => 71,
                "night_price" => 43.00,
                "address" => "Via Vesuvio 16",
                "city" => "Napoli",
                "lat" => "40.85809",
                "lon" => "14.29206",
                "visible" => true,
                "user_id" => 10,
            ],
        ];

        foreach ($data as $value) {
            $newValue = new Apartment();
            $newValue->title = $value["title"];
            $newValue->description = $value["description"];
            $newValue->cover_img = $value["cover_img"];
            $newValue->rooms = $value["rooms"];
            $newValue->beds = $value["beds"];
            $newValue->bathrooms = $value["bathrooms"];
            $newValue->square_metres = $value["square_metres"];
            $newValue->address = $value["address"];
            $newValue->night_price = $value["night_price"];
            $newValue->city = $value["city"];
            $newValue->lat = $value["lat"];
            $newValue->lon = $value["lon"];
            $newValue->visible = $value["visible"];
            $newValue->user_id = $value["user_id"];

            $newValue->save();
        }
    }
}
