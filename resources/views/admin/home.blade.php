@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            {{-- <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <h1 class="text-center">Dashboard con lista Appartamenti per utente</h1>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    {{ __('You are logged in!') }}

                </div>
            </div> --}}
            <h2>Benvenuto {{ Auth::user()->first_name }} <i class="far fa-wifi"></i></h2>
            <div class="row row-cols-1">
                @foreach ($apartments as $apartment)
                <div class="col">
                    <div class="card mb-3">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="#" class="img-fluid rounded-start" alt="...">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $apartment->title }}</h5>
                                    <p class="card-text">{{ $apartment->description }}</p>
                                    <p class="card-text">
                                        <small class="text-muted">Ultima modifica {{$apartment->updated_at }}
                                        </small>
                                    </p>
                                    <ul>
                                        @foreach($apartment->services as $service)
                                        <li>{{$service->name}} - {!! $service->icon !!}</li>
                                        @endforeach
                                    </ul>
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
@endsection