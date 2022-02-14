@extends('layouts.app')

@section('content')
<h1 class="text-center">sezione sponsor</h1>

<div class="container">
  <div class="row row-cols-3">
    @foreach ($sponsor as $single_sponsor)
    <div class="col d-flex justify-content-center text-center">

      {{-- Single Sponsor Card --}}
      <div class="card" style="width: 18rem;">
        <img src="" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">Tipo: {{ $single_sponsor->type }}</h5>
          <p class="card-text">Prezzo: {{ $single_sponsor->price }}</p>
          <p class="card-text">Durata: {{ $single_sponsor->duration }}</p>

          <a href="#" class="btn btn-primary">Buy</a>
        </div>
      </div>

    </div>
    @endforeach
  </div>
</div>

@endsection