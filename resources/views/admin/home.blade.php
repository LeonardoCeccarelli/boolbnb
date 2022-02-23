@extends('layouts.app')
@section('page_title', 'Dashboard | BoolBnB')
@section('content')
<div class="container-fluid"
  style="background: rgb(2,0,36);background: linear-gradient(180deg, rgba(2,0,36,1) 0%, rgba(9,70,121,1) 35%, rgba(161,232,246,1) 100%);">
  <div class="container  ">
    <div class="row justify-content-center">
      <div class="col-11 m-5">
        <div class="d-flex flex-column flex-md-row mb-4">
          <div class=" col col-md-7 py-3 text-white">
            <h3 class="mb-3">Buongiorno {{ Auth::user()->name }} <i class="far fa-wifi"></i></h3>
            <h2 class="fw-bold ">Benvenuto Nella Tua Area Riservata</h2>
          </div>
          <div class=" col col-md-5 d-flex justify-content-end align-items-center">
            <button type="button" class="btn btn-dark btn-lg col col-md-10 "><a href="{{ route('admin.apartment.create') }}"
                class="fs-6 fw-bold text-white text-decoration-none">AGGIUNGI UN APPARTAMENTO <i
                  class="fas fa-plus"></i></a></button>
          </div>
        </div>
        <div class="row row-cols-1 justify-content-center">
          @foreach ($apartments as $apartment)
          <div class="col-11">
            <div class="card mb-3 shadow p-3 mb-5 bg-body rounded">
              <div class="row  ">
                <div class="col-lg-4 mb-4 mb-md-0" style="position: relative;">
                  <img src="{{ asset('storage/' . $apartment->cover_img) }}" class="img-fluid rounded h-100 " alt="..." >
                  @foreach($apartment->sponsor as $sp)
                    <button type="button" class="btn btn-warning mb-2 text-uppercase fw-bold" style="position: absolute;top:10px;left:20px;">
                      {{$sp->type}}                   
                    </button>                                            
                  @endforeach
                </div>
                <div class="col-lg-6 mb-3 m-md-0 ">
                  <div class=" card-body d-flex p-0">
                    <div class="col-12 p-2">
                      <h5 class="card-title mb-3  ">
                        <a class="fw-bold text-decoration-none text-uppercase" style="color: #094679;"
                          href="{{ route('admin.apartment.show', $apartment->id) }}">
                          {{$apartment->title }}
                        </a>
                      </h5>
                      
                      {{-- <p class="card-text">{{ $apartment->description }}</p> --}}
                      <ul class="d-flex  flex-wrap flex-column flex-md-row p-0 list-unstyled ">
                        @foreach($apartment->services as $service)
                        <li class="me-5"><span class="me-1">{!! $service->icon !!}</span> {{$service->name}}</li>
                        @endforeach
                      </ul>
     
                      <p class="card-text">
                        <small class="text-muted ">Ultima modifica {{$apartment->updated_at }}</small>
                      </p>
                    </div>
                    
                  </div>
                </div>
                <div class="b col-lg-2 d-flex align-items-center justify-content-center">
                  <button type="button" class="btn btn-dark text-white mb-2  col-12 col-md-10 ">
                    <a class="text-white fw-bold text-decoration-none "
                      href="{{ route('admin.apartment.show', $apartment->id) }}">
                      Visualizza
                    </a>
      
                  </button>
                  
                  
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







