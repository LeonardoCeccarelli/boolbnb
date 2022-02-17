@extends('layouts.app')

@section('content')

<div class="container">

  @dump($user, $apartment);


  <h1 class="text-center color-success py-5">Congratulation {{$user->first_name}} Hai attivato la sponsorizzazzione per
    l'appartamento {{ $apartment->title }}
  </h1>

</div>


@endsection