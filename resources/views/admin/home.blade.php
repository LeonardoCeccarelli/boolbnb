@extends('layouts.app')
@section('page_title', 'Dashboard | BoolBnB')
@section('content')
    <div class="container-fluid home-admin">
        <div class="container">


            <div class="row justify-content-center">
                <div class="col-11 m-5">



                    <div class="mb-4">
                        <div class="row row-cols-1 row-cols-lg-2 justify-content-between align-items-center mb-5">
                        <div class="col mb-5 mb-lg-0">
                            <h2 class="mb-3">Buongiorno <strong>{{ Auth::user()->name }}</strong>,</h2>
                            <h3 class="fst-italic">benvenuto nella tua area riservata</h3>
                        </div>
                        <div class="col text-center text-lg-end">
                           <a class="button button_4"
                                    href="{{ route('admin.apartment.create') }}"
                                    class="fs-6 fw-bold text-white text-decoration-none">Aggiungi un
                                    appartamento</a>
                        </div>
                    </div>
                    </div>
                    <div class="row row-cols-1 justify-content-center">

                        {{-- SINGLE CARD --}}
                        @foreach ($apartments as $apartment)
                            <div class="col-11">
                                <div class="card mb-3 shadow p-3 mb-5 bg-body rounded ">
                                    <div class="row">
                                        <div class="col-lg-4 mb-4 mb-md-0" style="position: relative;">
                                            <div class="ratio ratio-4x3">
                                                <img src="{{ asset('storage/' . $apartment->cover_img) }}"
                                                    class="rounded" style="object-fit: cover;" alt="...">
                                            </div>
                                            @foreach ($apartment->sponsor as $sp)
                                                <div class="mb-2 py-2 px-3 sponsor-tag">
                                                    {{ $sp->type }}
                                                </div>
                                            @endforeach
                                        </div>

                                        {{-- CARD TEXT --}}
                                        <div class="col-lg-6">
                                            <div class=" card-body d-flex align-items-stretch h-100">
                                                <div class="col-12">
                                                    {{-- CARD-TITLE --}}
                                                    <h5 class="card-title">
                                                        <a class="fw-bold text-decoration-none text-uppercase" style="color:black;"
                                                            href="{{ route('admin.apartment.show', $apartment->id) }}">
                                                            {{ $apartment->title }}
                                                        </a>
                                                    </h5>

                                                    {{-- CARD-SERVICES --}}
                                                    <ul
                                                        class="d-flex flex-wrap flex-column flex-md-row p-0 list-unstyled my-5">
                                                        @foreach ($apartment->services as $service)
                                                            <li class="me-5"><span
                                                                    class="me-1">{!! $service->icon !!}</span>
                                                                {{ $service->name }}</li>
                                                        @endforeach
                                                    </ul>
                                                    {{-- CARD DATE --}}
                                                    <p class="card-text">
                                                        <small class="text-muted">Ultima modifica
                                                            {{ $apartment->updated_at }}</small>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>



                                        <div class="col-lg-2 d-flex align-items-center justify-content-center my-3">
                                            
                                                <a class="button button_2"
                                                    href="{{ route('admin.apartment.show', $apartment->id) }}">
                                                    Visualizza
                                                </a>

                                          


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
