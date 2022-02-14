<?php

namespace App\Http\Controllers\Admin;

use App\Apartment;
use App\Http\Controllers\Controller;
use App\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        // ESEGUIRE LA VALIDAZIONE

        $data = $request->all();
        $newApartment = new Apartment();

        $newApartment->fill($data);

        $newApartment->visible = $request["visible"] ? "1" : "0";

        $newApartment->user_id = Auth::user()->id;

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
        return view("admin.apartment.show", [
            "apartment" => $apartment,
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
        // ESEGUIRE VALIDAZIONE

        $data = $request->all();

        $oldImage = $apartment->cover_img;
        $apartment->fill($data);
        $apartment->visible = $request["visible"] ? "1" : "0";


        if ($request->file("coverImg")) {

            if ($oldImage) {
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

        $apartment->delete();

        return redirect()->view("admin.home");
    }
}
