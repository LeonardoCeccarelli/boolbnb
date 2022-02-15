@extends('layouts.app')

@section('page_title', mb_strimwidth($apartment->title, 0, 25, "...") . ' - Informazioni')

@section('content')
<div class="container">
    <h2>Stai visualizzando l'appartamento <b>{{ $apartment->title }}</b></h2>
    <div class="d-flex">
        <a href="{{ route('admin.apartment.edit', $apartment->id) }}" class="btn btn-success">Modifica</a>

        <form action="{{ route('admin.apartment.destroy', $apartment->id) }}" method="post" class="ms-3">

            @csrf
            @method('delete')

            <button type="submit" class="btn btn-danger">Elimina</button>

        </form>
    </div>
</div>
@endsection