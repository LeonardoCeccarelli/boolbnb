@extends('layouts.app')

@section('page_title', 'Visualizza | BoolBnB')

@section('content')

@if ($apartment->user_id == $user->id)

<div class="container-fluid"
  style="background: rgb(2,0,36);background: linear-gradient(180deg, rgba(2,0,36,1) 0%, rgba(9,70,121,1) 35%, rgba(161,232,246,1) 100%);">
  <div class="container pt-5 d-flex flex-column align-items-center ">

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


    <section class="infos d-flex flex-column flex-xl-row col-11  ">
      <div class="left col-xl-7  bg-light p-5 pt-3">

        {{-- immagini / carosello --}}
        <h4 class="fw-bold mb-4">Immagini Appartamento</h4>
        <div class="rounded"  style="position: relative;">
          <img src="{{ asset('storage/' . $apartment->cover_img) }}" class="img-fluid rounded border" alt="...">
          @foreach($apartment->sponsor as $sp)
            <button type="button" class="btn btn-warning mb-2 text-uppercase fw-bold" style="position: absolute;top:15px;left:20px;">
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

      <div class="right  col-xl-5 bg-light p-5 ">

        <div class="rounded shadow col-10  p-3 pb-5" style="background-color: #094679; ">
          <ul class="rounded text-white list-unstyled p-3 ">
            {{-- messages button --}}
            <li class="mb-4 d-flex fs-5">

              <a href="{{ route('admin.message', $apartment->id) }}"
                class="fw-bold mb-1 text-white text-decoration-none">
                Visualizza I Tuoi Messaggi <i class="fas fa-arrow-alt-circle-right"></i>
              </a>
            </li>
            <hr>
            {{-- sponsor button --}}
            <li class="mb-4 fs-5 mt-4">

              <a href="{{ route('admin.sponsor.index', $apartment) }}"
                class="fw-bold mb-1 text-white text-decoration-none">
                Prova Un Piano Di Sponsorship <i class="fas fa-arrow-alt-circle-right"></i>
              </a>

            </li>
            <hr>
            {{-- edit button --}}
            <li class="mb-4 fs-5 mt-4">
              <a href="{{ route('admin.apartment.edit', $apartment->id) }}"
                class="fw-bold mb-1 text-white text-decoration-none">
                Modifica Il Tuo Annuncio <i class="fas fa-arrow-alt-circle-right"></i>
              </a>

            </li>
            <hr>
            {{-- delete button --}}
            <li class="mb-4 fs-5 mt-4">

              <p class="fw-bold mb-1">Vuoi Eliminare il tuo annuncio ?</p>
              <!-- Button trigger modal -->
              <button type="button" class="btn btn-danger  text-white" data-bs-toggle="modal"
                data-bs-target="#exampleModal">
                Elimina Annuncio
              </button>

              <!-- Modal -->
              <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title text-dark" id="exampleModalLabel">Vuoi Eliminare Il tuo Annuncio?</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-dark">
                      Selezionando Conferma Il tuo Annuncio Verrà Elimnato.
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-primary text-white" data-bs-dismiss="modal">Annulla</button>
                      <form action="{{ route('admin.apartment.destroy', $apartment->id) }}" method="post" {{--
                        onsubmit="return confirm('Vuoi Eliminare Il tuo Annuncio ?')" --}}>
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger text-white">Conferma</button>


                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </li>
          </ul>
        </div>

      </div>
    </section>



    {{-- statistiche --}}
    <section class="bg-light col-11 mb-5 p-5 pt-0 rounded-bottom">
      <hr>
      <h4 class="fw-bold mt-4">Statistiche Del Tuo Annuncio</h4>
    </section>
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
              <h5 class="card-title mb-2">Lappartamento selezionato non è visualizzabile.</h5>
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