@extends('layouts.app')

@section('page_title', mb_strimwidth($apartment->title, 0, 25, "...") . ' - Informazioni')

@section('content')
<div class="container-fluid" style="background: rgb(2,0,36);background: linear-gradient(180deg, rgba(2,0,36,1) 0%, rgba(9,70,121,1) 35%, rgba(161,232,246,1) 100%);">
    <div class="container pt-5 d-flex flex-column align-items-center ">

        {{-- titolo / info base --}}
        <section class="bg-light col-11 mt-5 p-5  rounded-top">
            <div class="row row-cols-2">
                <div class="div col-8">
                    <h3 class="fw-bold">{{ $apartment->title }}</h3>
                </div>
                <div class="div col-4 text-start ps-5">
                    <p class="text-capitalize"><i class="fas fa-map-marker-alt fs-5"></i> <span class="fs-5 fw-bold">Posizione: </span>  {{ $apartment->city }}</p>
                    <p><i class="fas fa-tag fs-5"></i><span class="fs-5 fw-bold"> Prezzo a notte: </span>  {{ $apartment->night_price}} Euro </p>
                </div>
            </div>
            <div class=" mt-4 flex-wrap">
                <h4 class="fw-bold">Informazioni Generali</h4>
                <ul class=" d-flex">
                    <li class="mx-2 me-4">{{ $apartment->square_metres }} m²</li>
                    <li class="mx-2 me-4">Letti: {{ $apartment->beds}}</li>
                    <li class="mx-2 me-4">Stanze: {{ $apartment->rooms}}</li>
                    <li class="mx-2 me-4">Bagni: {{ $apartment->bathrooms }}</li>
                </ul>
            </div>            
            <hr class="">      
        </section>
    
        
        <section class="infos d-flex col-11 ">
            <div class="left col-6 border bg-light p-5">
    
                {{-- immagini / carosello --}}
                <h4 class="fw-bold">Immagini Appartamento</h4>
                <img src="{{ asset('storage/' . $apartment->cover_img) }}"  alt=" {{$apartment->cover_img}}" style="width: 400px;height.400px;">    
            
                {{-- descrizione appartamento --}}
                <h4 class="fw-bold">Descrizione</h4>
                <p>{{ $apartment->description }}</p>
                
                {{-- Servizzi --}}
                <h4 class="fw-bold">Servizzi</h4>
                <ul class="d-flex  flex-wrap p-0 list-unstyled ">
                    @foreach($apartment->services as $service)
                    <li class="me-3"><span class="me-1">{!! $service->icon !!}</span>
                        {{$service->name}}</li>
                    @endforeach
                </ul>
                
            </div>
            <div class="right col-6 border bg-light p-5">
    
                {{-- edit button --}}
                <a href="{{ route('admin.apartment.edit', $apartment->id) }}" class="btn btn-success">Modifica</a>
    
                {{-- messages button --}}
                {{-- <a href="{{route('admin.messages.index')}}">messaggi</a> --}}
    
                {{-- delete button --}}
                <form action="{{ route('admin.apartment.destroy', $apartment->id) }}" method="post" class="ms-3">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger">Elimina</button>
                </form>
            </div>
        </section>
      
    
        {{-- statistiche --}}
        <section class="bg-light col-11 mb-5 p-5 rounded-bottom">
            statistiche appartamento
        </section>
    </div>
</div>

@endsection