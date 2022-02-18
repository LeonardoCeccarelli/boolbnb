<?php

namespace App\Http\Controllers\Admin;

use App\Apartment;
use App\Http\Controllers\Controller;
use App\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class ApartmentController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    // Il metodo index è gestito dall' Admin/HomeController@index 
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $services = Service::all();

    return view("admin.apartment.create", [
      "services" => $services,
    ]);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    // Data validation
    $request->validate([
      'title' => 'required|min:5|max:100',
      'description' => 'required|min:25|max:1000',
      'rooms' => 'required|min:1',
      'beds' => 'required|min:1',
      'bathrooms' => 'required|min:1',
      'night_price' => 'required|min:1|max:9999',
      'address' => 'required',
      'city' => 'required',
    ]);

    // Data to format url string
    $address = str_replace(' ', '%20', $request['address']);
    $city = $request['city'];
    $key = '74G2HVlLeNW6ZnVG4yzsaMj20OxuW1sJ';
    $baseUrl = 'https://api.tomtom.com/search/2/geocode/';
    $endUrl = '.json?key=';
    $url = $baseUrl . $city . '%20' . $address . $endUrl . $key;

    // Chiamata APi per ricevere lat e lon
    $response = Http::get($url);
    $lat = $response->json()['results'][0]['position']['lat'];
    $lon = $response->json()['results'][0]['position']['lon'];
    // Fine chiamata API

    $data = $request->all();
    $newApartment = new Apartment();
    $newApartment->fill($data);
    $newApartment->visible = $request["visible"] ? "1" : "0";
    $newApartment->lat = $lat;
    $newApartment->lon = $lon;
    $newApartment->user_id = Auth::user()->id;

    if ($request->file("cover_img")) {
      $newApartment->cover_img = Storage::put("apartments", $data["cover_img"]);
    } else {
      $newApartment->cover_img = "apartments/default.png";
    }

    $newApartment->save();



    if (array_key_exists("services", $data)) {
      $newApartment->services()->sync($data["services"]);
    }

    return redirect()->route("admin.apartment.show", $newApartment->id);
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show(Apartment $apartment)
  {
    $user = Auth::user();

    return view("admin.apartment.show", [
      "apartment" => $apartment,
      "user" => $user,
    ]);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit(Apartment $apartment)
  {

    $services = Service::all();

    return view("admin.apartment.edit", [
      "apartment" => $apartment,
      "services" => $services,
    ]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Apartment $apartment)
  {
    // Data validation
    $request->validate([
      'title' => 'required|min:5|max:100',
      'description' => 'required|min:25|max:1000',
      'rooms' => 'required|min:1',
      'beds' => 'required|min:1',
      'bathrooms' => 'required|min:1',
      'night_price' => 'required|min:1|max:9999',
    ]);

    $data = $request->all();

    $oldImage = $apartment->cover_img;
    $apartment->fill($data);
    $apartment->visible = $request["visible"] ? "1" : "0";


    if ($request->file("cover_img")) {

      if ($oldImage && $oldImage != "apartments/default.png") {
        Storage::delete($oldImage);
      }

      $apartment->cover_img = $request->file("cover_img")->store("apartments");
    }

    $apartment->save();

    if (array_key_exists("services", $data)) {
      $apartment->services()->sync($data["services"]);
    } else {
      $apartment->services()->detach();
    }

    return redirect()->route("admin.apartment.show", $apartment->id);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(Apartment $apartment)
  {
    $apartment->services()->detach();

    if ($apartment->cover_img != "apartments/default.png") {
      Storage::delete($apartment->cover_img);
    }

    $apartment->delete();

    return redirect()->route("admin.home");
  }
}
