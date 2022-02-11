<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Sponsor;
use Illuminate\Http\Request;

class SponsorController extends Controller
{
  public function index()
  {
    $sponsor = Sponsor::all();

    return view("admin.sponsor.index", compact('sponsor'));
  }
}
