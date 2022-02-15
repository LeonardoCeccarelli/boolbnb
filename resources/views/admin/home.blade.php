@extends('layouts.app')

@section('page_title', 'Dashboard | BoolBnB')

@section('content')
<div class="container-fluid" style="background: rgb(2,0,36);background: linear-gradient(180deg, rgba(2,0,36,1) 0%, rgba(9,70,121,1) 35%, rgba(161,232,246,1) 100%);">
    <div class="container  " >
        <div class="row justify-content-center">
            <div class="col-11 m-5">
                <div class="d-flex mb-4">
                    <div class="col-8 py-3 text-white">
                        <h3 class="mb-3">Buongiorno {{ Auth::user()->first_name }} <i class="far fa-wifi"></i></h3>
                        <h2 class="fw-bold ">Benvenuto Nella Tua Area Riservata</h2>
                    </div>
                    <div class="col-4 d-flex justify-content-end align-items-center">  
                        <button type="button" class="btn btn-dark btn-lg "><a href="{{ route('admin.apartment.create') }}" class="fs-6 fw-bold text-white text-decoration-none">AGGIUNGI UN APPARTAMENTO <i class="fas fa-plus"></i></a></button>
                    </div>
                </div>
                
                
                <div class="row row-cols-1 justify-content-center">
                    @foreach ($apartments as $apartment)
                    <div class="col-11">
                        <div class="card mb-3 shadow p-3 mb-5 bg-body rounded">
                            <div class="row g-0 ">
                                <div class="col-md-3 border">
                                    <img src="#" class="img-fluid rounded-start border" alt="...">
                                </div>
                                <div class="col-md-9 ">
                                    <div class="card-body d-flex p-0">
    
                                        <div class="a col-10 p-2">
                                            <h5 class="card-title mb-3">
                                                <a class="text-dark fw-bold text-decoration-none text-uppercase" href="{{ route('admin.apartment.show', $apartment->id) }}">
                                                    {{$apartment->title }}
                                                </a>
                                            </h5>
                                            {{-- <p class="card-text">{{ $apartment->description }}</p> --}}
                                            <ul class="d-flex  flex-wrap p-0 list-unstyled ">
                                                @foreach($apartment->services as $service)
                                                <li class="me-3"><span class="me-1">{!! $service->icon !!}</span> {{$service->name}}</li>
                                                @endforeach
                                            </ul>
                                            <p class="card-text">
                                                <small class="text-muted">Ultima modifica {{$apartment->updated_at }}</small>
                                            </p>
                                        </div>
    
                                        <div class="b col-2 d-flex align-items-center ">
                                            <button type="button" class="btn btn-dark text-white mb-2">
                                                <a class="text-white fw-bold text-decoration-none " href="{{ route('admin.apartment.show', $apartment->id) }}">
                                                    Visualizza
                                                </a>                       
                                            </button>
                                        </div>
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
    
                </div>
            </div>
        </div>
    </div>
</div>

@endsection