<?php

use App\Apartment;
use Illuminate\Database\Seeder;

class AddImgApartments extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = Apartment::all();

        foreach ($data as $value) {
            if (!$value->cover_img) {
                $value->cover_img = "apartments/default.png";
                $value->save();
            }
        }
    }
}
