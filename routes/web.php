<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::middleware("auth")
  ->namespace("Admin")
  ->name("admin.")
  ->prefix("admin")
  ->group(function () {
    Route::get("/", "HomeController@index")->name("home");

    Route::resource("/apartment", "ApartmentController");
    Route::get("/sponsor", "SponsorController@index")->name("sponsor.index");
    Route::get("/checkout", "SponsorController@checkout")->name("sponsor.checkout");
  });

Route::get("{any?}", function () {
  return view("guests.welcome");
})->where("any", ".*");
