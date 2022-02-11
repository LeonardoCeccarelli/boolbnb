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
        "icon" => '<i class="fas fa-wifi"></i>',
      ],
      [
        "name" => "Posto Macchina",
        "icon" => '<i class="fas fa-car"></i>',
      ],
      [
        "name" => "Piscina",
        "icon" => '<i class="fas fa-swimmer"></i>',
      ],
      [
        "name" => "Portineria",
        "icon" => '<i class="fas fa-concierge-bell"></i>',
      ],
      [
        "name" => "Cucina",
        "icon" => '<i class="fas fa-utensils"></i>',
      ],
      [
        "name" => "Sauna",
        "icon" => '<i class="fas fa-hot-tub"></i>',
      ],
      [
        "name" => "Vista mare",
        "icon" => '<i class="fas fa-umbrella-beach"></i>',
      ],
      [
        "name" => "Palestra",
        "icon" => '<i class="fas fa-dumbbell"></i>',
      ],
      [
        "name" => "Aria condizionata",
        "icon" => '<i class="fas fa-wind"></i>',
      ],
      [
        "name" => "TV",
        "icon" => '<i class="fas fa-tv"></i>',
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
