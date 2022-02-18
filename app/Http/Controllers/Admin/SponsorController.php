<?php

namespace App\Http\Controllers\Admin;

use App\Apartment;
use App\Http\Controllers\Controller;
use App\Sponsor;
use Braintree;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SponsorController extends Controller
{
  public function index(Apartment $apartment)
  {
    $sponsorsList = Sponsor::all();
    $now = Carbon::now();

    $expiring = false;
    $end_date = false;

    if (count((array)$apartment->sponsor) != 0) {

      foreach ($apartment->sponsor as $sponsor) {
        $end_date = $sponsor->pivot->end_date;
        if ($end_date < $now) {
          $apartment->sponsor()->detach($sponsor);
        }
      }
      $expiring = new Carbon($end_date);
    }
    
    $gateway = new Braintree\Gateway([
      'environment' => env('BTREE_ENVIRONMENT'),
      'merchantId' => env('BTREE_MERCHANT_ID'),
      'publicKey' => env('BTREE_PUBLIC_KEY'),
      'privateKey' => env('BTREE_PRIVATE_KEY')
    ]);

    $clientToken = $gateway->clientToken()->generate();

    return view("admin.sponsor.index", [
      'sponsor' => $sponsorsList,
      'clientToken' => $clientToken,
      'apartment' => $apartment,
      'now' => $now,
      'expiring' => $expiring,
      'end_date' => $end_date,
    ]);
  }

  public function checkout(Request $request, Apartment $apartment)
  {

    $gateway = new Braintree\Gateway([
      'environment' => env('BTREE_ENVIRONMENT'),
      'merchantId' => env('BTREE_MERCHANT_ID'),
      'publicKey' => env('BTREE_PUBLIC_KEY'),
      'privateKey' => env('BTREE_PRIVATE_KEY')
    ]);

    $selected_sponsor = Sponsor::where('id', $request->sponsor_select)->first();
    $amount = $selected_sponsor->price;
    $nonce = 'fake-valid-nonce';

    $result = $gateway->transaction()->sale([
      'amount' => $amount,
      'paymentMethodNonce' => $nonce,
      'options' => [
        'submitForSettlement' => true
      ]
    ]);

    // Executed Transaction
    if ($result->success || !is_null($result->transaction)) {
      // $transaction = $result->transaction;

      if (isset($request->sponsor_select)) {
        $expiring_date = Carbon::now('Europe/Rome')->addHours($selected_sponsor->duration);

        // Insert starting and ending date in  apartment_sponsor pivot table
        $apartment->sponsor()->attach($selected_sponsor, [
          'end_date' => $expiring_date,
          'starting_date' => Carbon::now('Europe/Rome'),
        ]);
      }

      return redirect()->route('admin.sponsor.transaction', [
        'apartment' => $apartment
      ]);
    }
    // Failed Transaction
    else {
      $errorString = "";

      foreach ($result->errors->deepAll() as $error) {
        $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
      }
      return redirect()->route('admin.apartment.show', [
        'apartment' => $apartment
      ]);
    }
  }

  public function transaction(Apartment $apartment)
  {
    $user = Auth::user();
    // dd($user, $apartment);

    return view('admin.sponsor.transaction', [
      'apartment' => $apartment,
      'user' => $user
    ]);
  }
}
