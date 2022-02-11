<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
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
        "first_name" => "Francesco",
        "last_name" => "Andreotti",
        "email" => "francescoandreotti@gmail.com",
        "password" => "12345678",
        "date_of_birth" => "2000-04-07",
      ],
      [
        "first_name" => "Giovanni",
        "last_name" => "Conti",
        "email" => "giovanniconti@gmail.com",
        "password" => "12345678",
        "date_of_birth" => "1995-04-04",
      ],
      [
        "first_name" => "Omar",
        "last_name" => "Dridi",
        "email" => "omardridi@gmail.com",
        "password" => "12345678",
        "date_of_birth" => "1996-04-04",
      ],
      [
        "first_name" => "Sonia",
        "last_name" => "Guarino",
        "email" => "soniaguarino@gmail.com",
        "password" => "12345678",
        "date_of_birth" => "2002-04-04",
      ],
      [
        "first_name" => "Leonardo",
        "last_name" => "Ceccarelli",
        "email" => "leonardoceccarelli@gmail.com",
        "password" => "12345678",
        "date_of_birth" => "1997-04-04",
      ],
    ];

    foreach ($data as $value) {
      $newValue = new User();

      $newValue->first_name = $value["first_name"];
      $newValue->last_name = $value["last_name"];
      $newValue->email = $value["email"];
      $newValue->password = Hash::make($value["password"]);
      $newValue->date_of_birth = $value["date_of_birth"];
      $newValue->save();
    }
  }
}
