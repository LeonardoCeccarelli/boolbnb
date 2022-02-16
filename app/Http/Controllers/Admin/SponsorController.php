<?php

namespace App\Http\Controllers\Admin;

use App\Apartment;
use App\Http\Controllers\Controller;
use App\Sponsor;
use Braintree;
use Illuminate\Http\Request;

class SponsorController extends Controller
{
  public function index(Apartment $apartment)
  {
    $sponsor = Sponsor::all();

    $gateway = new Braintree\Gateway([
      'environment' => env('BTREE_ENVIRONMENT'),
      'merchantId' => env('BTREE_MERCHANT_ID'),
      'publicKey' => env('BTREE_PUBLIC_KEY'),
      'privateKey' => env('BTREE_PRIVATE_KEY')
    ]);

    $clientToken = $gateway->clientToken()->generate();
    // dd($clientToken);

    return view("admin.sponsor.index", compact('sponsor', 'clientToken', 'apartment'));
  }

  public function checkout()
  {
  }
}
