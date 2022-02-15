@extends('layouts.app')

@section('page_title', mb_strimwidth($apartment->title, 0, 25, "...") . ' - Informazioni')

@section('content')
<div class="container col-10 border my-5" style="background: rgb(2,0,36);
background: linear-gradient(180deg, rgba(2,0,36,1) 0%, rgba(9,70,121,1) 35%, rgba(161,232,246,1) 100%);">

    {{-- titolo / info base --}}
    <section class="text-center text-white">
            <h3>{{ $apartment->title }}</h3>
            <p>{{ $apartment->city }} - Prezzo a notte{{ $apartment->night_price}}</p>
            <ul class="list-unstyled">
                <li>Mq {{ $apartment->square_metres }}</li>
                <li>letti {{ $apartment->beds}}</li>
                <li>stanze {{ $apartment->rooms}}</li>
                <li>bagni {{ $apartment->bathrooms }}</li>
            </ul>

    </section>

    <section class="d-flex justify-content-center">
        <div class="infos d-flex col-10 ">
            <div class="left col-6 border">
    
                 {{-- immagini / carosello --}}
                <section>   
                    <img src="{{ asset('storage/' . $apartment->cover_img) }}"  alt=" {{$apartment->cover_img}}" style="width: 400px;height.400px;">    
                </section>
        
                {{-- descrizione appartamento --}}
                <section>
                    <p>{{ $apartment->description }}</p>
                </section>
            
                {{-- Servizzi --}}
                <section>
                    <ul class="d-flex  flex-wrap p-0 list-unstyled ">
                        @foreach($apartment->services as $service)
                        <li class="me-3"><span class="me-1">{!! $service->icon !!}</span>
                            {{$service->name}}</li>
                        @endforeach
                    </ul>
                </section>
            </div>
            <div class="right col-6 border">
    
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
        </div>
    </section>

    {{-- statistiche --}}
    <section>
        statistiche appartamento
    </section>
</div>
@endsection