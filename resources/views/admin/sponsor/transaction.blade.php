@extends('layouts.app')

@section('content')
<div class="container-fluid p-5"
  style="background: rgb(2,0,36);background: linear-gradient(180deg, rgba(2,0,36,1) 0%, rgba(9,70,121,1) 35%, rgba(161,232,246,1) 100%);">

    <div class="container bg-light rounded p-5 text-center">

      <h1 class="fw-bold">Congratulazioni {{ Auth::user()->name }}</h1>
      <h3 class="mb-4">Hai attivato la sponsorizazzione per il tuo annuncio </h3>
      <h3 class="mb-4" >{{ $apartment->title }}</h3>
      <a href="{{ route('admin.home') }}">Torna Nella Tua Dashboard</a>
    </div>
</div>


@endsection