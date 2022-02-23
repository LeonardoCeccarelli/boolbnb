@extends('layouts.app')

@section('page_title', 'Visualizza | BoolBnB')

@section('content')

@if ($apartment->user_id == $user->id)

<div class="container-fluid">
  <div class="container d-flex flex-column align-items-center border position-relative">

    {{-- titolo / info base --}}
    <section class="bg-light col-11 mt-5 p-5 pb-0  rounded-top">
      <div class="row  row-cols-md-2 flex-column flex-md-row">

        <div class="div col-12 col-md-7 ">

          <h3 class="fw-bold pb-3 text-uppercase" style="color: #094679; word-wrap: break-word;">{{ $apartment->title }}
          </h3>
          <div class=" mt-4 ">
            <h4 class="fw-bold">Informazioni Generali</h4>
            <ul class=" d-flex flex-wrap">
              <li class="mx-2 me-4">{{ $apartment->square_metres }} m²</li>
              <li class="mx-2 me-4">Letti: {{ $apartment->beds}}</li>
              <li class="mx-2 me-4">Stanze: {{ $apartment->rooms}}</li>
              <li class="mx-2 me-4">Bagni: {{ $apartment->bathrooms }}</li>
            </ul>
          </div>
        </div>

        <div class="col-12  col-md-5   p-2  ps-lg-5 pt-md-5">
          <div class=" d-flex flex-row flex-md-column ms-lg-5">
            <p class="text-capitalize me-5 me-md-0"><i class="fas fa-map-marker-alt fs-5"></i> <span
                class="fs-5 fw-bold">Posizione: </span> {{ $apartment->city }}</p>
            <p><i class="fas fa-tag fs-5"></i><span class="fs-5 fw-bold"> Prezzo a notte: </span> {{
              $apartment->night_price}} Euro </p>
          </div>
        </div>
      </div>

      <hr>
    </section>


    <section class="infos d-flex justify-content-center col-11  my-4">
      <div class="left col-9  bg-light p-5 pt-3  shadow rounded ">

        {{-- immagini / carosello --}}
      
        <div class="rounded py-4"  style="position: relative;">
          
          <img src="{{ asset('storage/' . $apartment->cover_img) }}" class="img-fluid rounded border" alt="...">
          @foreach($apartment->sponsor as $sp)
            <button type="button" class="btn btn-warning mb-2 text-uppercase fw-bold" style="position: absolute;top:40px;left:20px;">
              {{$sp->type}}                   
            </button>                                            
          @endforeach
        </div>
        


        <hr>
        {{-- descrizione appartamento --}}
        <h4 class="fw-bold mt-4 mb-4 ">Descrizione</h4>
        <div class="mb-4 ">
          <p style="word-wrap: break-word;">{{ $apartment->description }}</p>

        </div>
        <hr>
        {{-- Servizi --}}
        <h4 class="fw-bold mt-4 mb-4">Servizi</h4>
        <ul class="d-flex  flex-wrap p-0 list-unstyled ">
          @foreach($apartment->services as $service)
          <li class="me-3"><span class="me-1">{!! $service->icon !!}</span>
            {{$service->name}}</li>
          @endforeach
        </ul>

      </div>   
    </section>


    {{-- statistiche --}}
    <section class="bg-light col-11 mb-5 p-5 pt-0 rounded-bottom">
      <hr>
      <h4 class="fw-bold mt-4">Statistiche Del Tuo Annuncio</h4>
    </section>

    <div class="position-absolute" style="right: 0;top:500px;">
      <p><i class="fas fa-envelope fs-1"></i></p>
      <p><i class="fas fa-crown fs-1"></i></p>
      <p><i class="fas fa-pen fs-1"></i></p>
      <p><i class="fas fa-trash fs-1"></i></p>
    </div>
  </div>
</div>


@else

<div class="container">
  <div class="row justify-content-center my-5">
    <div class="col-6">
      <div class="card mb-3">
        <div class="row g-0">
          <div class="col-md-4">
            <img src="{{ asset('storage/' . $apartment->cover_img) }}" class="img-fluid rounded-start" alt="...">
          </div>
          <div class="col-md-8 d-flex align-items-center">
            <div class="card-body text-center">
              <h5 class="card-title mb-2">L'appartamento selezionato non è visualizzabile.</h5>
              <a href="{{ route('admin.home') }}" class="btn btn-primary text-light">I miei appartamenti</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endif


@endsection