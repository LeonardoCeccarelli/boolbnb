@extends('layouts.app')

@section('content')

<style>
  .bg-image {
      background-image: url("/img/login_bg.jpg");
      background-size: cover;
      min-height: 600px;
  }

</style>

<div class="container-fluid p-5 bg-image"
    style="">

    <div class="container bg-light p-5 text-center"
      style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px; opacity: 0.9; width:60%; border-radius: 20px;">

      <h1 class="fw-bold">Congratulazioni {{ Auth::user()->name }}</h1>
      <h3 class="mb-4">Hai attivato la sponsorizazzione per il tuo annuncio </h3>
      <h3 class="mb-4" >{{ $apartment->title }}</h3>
      <a href="{{ route('admin.home') }}">Torna Nella Tua Dashboard</a>
    </div>
</div>


@endsection