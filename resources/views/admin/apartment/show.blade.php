@extends('layouts.app')

@section('page_title', 'Visualizza Annuncio | BoolBnB')

@section('content')
<div class="container-fluid" style="background: rgb(2,0,36);background: linear-gradient(180deg, rgba(2,0,36,1) 0%, rgba(9,70,121,1) 35%, rgba(161,232,246,1) 100%);">
    <div class="container pt-5 d-flex flex-column align-items-center ">

        {{-- titolo / info base --}}
        <section class="bg-light col-11 mt-5 p-5 pb-0  rounded-top">
            <div class="row  row-cols-md-2 flex-column flex-md-row">

                <div class="div col-8">
                    <h3 class="fw-bold pb-3 text-uppercase" style="color: #094679;" >{{ $apartment->title }}</h3>
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

                <div class="col-12  col-md-6 col-lg-4 p-2  ps-md-5 pt-md-5">
                    <div class=" d-flex flex-row flex-md-column ms-lg-5">
                        <p class="text-capitalize me-5 me-md-0"><i class="fas fa-map-marker-alt fs-5"></i> <span class="fs-5 fw-bold">Posizione: </span>  {{ $apartment->city }}</p>
                        <p><i class="fas fa-tag fs-5"></i><span class="fs-5 fw-bold"> Prezzo a notte: </span>  {{ $apartment->night_price}} Euro </p>
                    </div>
                </div>
            </div>
                     
            <hr>      
        </section>
    
        
        <section class="infos d-flex flex-column flex-xl-row col-11  ">
            <div class="left col-xl-7  bg-light p-5 pt-3">
    
                {{-- immagini / carosello --}}
                <h4 class="fw-bold mb-4">Immagini Appartamento</h4>
                <div class=" bg-success img-fluid" style="min-width: 100px;max-width: 580px;min-height:200px;">
                    <img src="{{ asset('storage/' . $apartment->cover_img) }}"  alt=" {{$apartment->cover_img}}" class="rounded mb-4 img-fluid" style="min-width: 100px;max-width: 580px;min-height:200px;">    

                </div>
                <hr>
                {{-- descrizione appartamento --}}
                <h4 class="fw-bold mt-4 mb-4">Descrizione</h4>               
                <p class="mb-4" >{{ $apartment->description }}</p>              
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
                <div class="shadow p-3  pt-4 mb-5 bg-body rounded d-flex flex-column align-items-center" >
                   
                    
                    <ul style="background-color: #094679; " class="rounded text-white list-unstyled p-3 ">
                        {{-- messages button --}}
                        <li class="mb-3 d-flex">
                          
                            <a href="{{ route('admin.message', $apartment->id) }}" class="fw-bold mb-1 text-white text-decoration-none" >
                                Visualizza I Tuoi Messaggi <i class="fas fa-arrow-alt-circle-right"></i>
                            </a> 
                        </li>
                        {{-- sponsor button --}}
                        <li class="mb-4">
                            <p class="fw-bold mb-1">Dai Un Boost Alle Tue Prenotazioni</p>
                            <a href="{{ route('admin.sponsor') }}" class="btn btn-light btn-sm text-dark">
                                Prova Un Piano Di Sponsorship <i class="fas fa-arrow-alt-circle-right"></i>
                            </a> 
                        </li>
                        {{-- edit button --}}
                        <li class="mb-4">                            
                            <p class="fw-bold mb-1">Vuoi Modificare Il Tuo Annuncio ?</p>
                            <a href="{{ route('admin.apartment.edit', $apartment->id) }}" class="btn btn-light btn-sm text-dark">
                                Modifica Il Tuo Annuncio <i class="fas fa-arrow-alt-circle-right"></i>
                            </a> 
                        </li>
                         {{-- delete button --}}
                        <li class="mb-4">
                            
                            <p class="fw-bold mb-1">Vuoi Eliminare il tuo annuncio ?</p>
                            <form action="{{ route('admin.apartment.destroy', $apartment->id) }}" method="post" onsubmit="return confirm('Vuoi Eliminare Il tuo Annuncio ?')">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger btn-sm text-white">Elimina Annuncio</button>
                            </form>
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

@endsection