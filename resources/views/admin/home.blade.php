@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h2>Benvenuto {{ Auth::user()->first_name }} <i class="far fa-wifi"></i></h2>
            <a href="{{ route('admin.apartment.create') }}">Crea nuovo</a>
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
                                    <h5 class="card-title">
                                        <a href="{{ route('admin.apartment.show', $apartment->id) }}">
                                            {{$apartment->title }}
                                        </a>
                                    </h5>
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