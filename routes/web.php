<?php

use App\Service;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the 'web' middleware group. Now create something great!
|
*/

Auth::routes();
Route::get('/show_view', function () {
  return view('guests.apartments.show');
});

// Route::get('/index_view', function () {
//   $services = Service::all();
//   return view('guests.apartments.index', [
//     "services" => $services,
//   ]);
// });


Route::middleware('auth')
  ->namespace('Admin')
  ->name('admin.')
  ->prefix('admin')
  ->group(function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::resource('/apartment', 'ApartmentController');
    Route::resource('/message', 'MessageController');
    Route::get('/sponsor/{apartment}', 'SponsorController@index')->name('sponsor.index');
    Route::post('/sponsor/{apartment}/checkout', 'SponsorController@checkout')->name('sponsor.checkout');
    Route::get('/sponsor/{apartment}/transaction', 'SponsorController@transaction')->name('sponsor.transaction');
    

  
  });
Route::get('{any?}', function () {
  return view('guests.welcome');
})->where('any', '.*');
