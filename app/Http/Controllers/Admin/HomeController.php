<?php

namespace App\Http\Controllers\Admin;

use App\Apartment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
  public function index()
  {
    $apartments = Apartment::orderBy("created_at", "DESC")
      ->where("user_id", Auth::user()->id)
      ->with(["services", "images", "sponsor", "user"])->get();

    // dd($apartments);

    return view("admin.home", compact("apartments"));
  }
}
