@extends('layouts.app')

@section('page_title', mb_strimwidth($apartment->title, 0, 25, '...') . ' - Modifica Appartamento')

@section('content')
    <div class="container">
        <div class="mb-5 pb-5 text-center">
            <h2>Ciao {{ Auth::user()->first_name }}</h2>
            <h4>In questa sezione puoi modificare l'appartamento: <br>
                <span class="fw-bold">{{ $apartment->title }}</span>
            </h4>
        </div>
        <form action="{{ route('admin.apartment.update', $apartment->id) }}" enctype="multipart/form-data" method="POST"
            class="row justify-content-center gy-5">
            @csrf
            @method('PUT')

            <div class="col-8">
                <div class="form-check form-switch">
                    <input class="form-check-input" name="visible" type="checkbox" role="switch" id="flexSwitchCheckChecked"
                        @if ($apartment->visible) checked @endif>
                    <label class="form-check-label" for="flexSwitchCheckChecked">Visibile</label>
                </div>
            </div>

            <div class="col-12 col-md-10 col-lg-8">
                <label for="field_title" class="form-label">Titolo</label>
                <input type="text" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" name="title"
                    id="field_title" value="{{ old('title') ?? $apartment->title }}">

                @if ($errors->has('title'))
                    <div class="invalid-feedback">
                        {{ $errors->get('title')[0] }}
                    </div>
                @endif
            </div>

            <div class="col-12 col-md-10 col-lg-8">
                <label class="form-label">Descrizione</label>
                <textarea type="text" rows="5" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"
                    name="description">{{ old('description') ?? $apartment->description }}</textarea>

                @if ($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->get('description')[0] }}
                    </div>
                @endif
            </div>

            <div class="col-12 col-md-10 col-lg-8">
                <label for="field_cover_img" class="form-label">Link Immagine</label>
                <input type="file" class="form-control {{ $errors->has('cover_img') ? 'is-invalid' : '' }}"
                    name="cover_img" id="field_cover_img" value="{{ old('cover_img') ?? $apartment->cover_img }}">

                @if ($errors->has('cover_img'))
                    <div class="invalid-feedback">
                        {{ $errors->get('cover_img')[0] }}
                    </div>
                @endif
            </div>

            <div class="col-12 col-md-10 col-lg-8">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-xl-5 g-3">
                    <div class="col">
                        <label for="field_rooms" class="form-label">N° Stanze</label>
                        <input type="number" min="1" max="20"
                            class="form-control {{ $errors->has('rooms') ? 'is-invalid' : '' }}" name="rooms"
                            id="field_rooms" value="{{ old('rooms') ?? $apartment->rooms }}">

                        @if ($errors->has('rooms'))
                            <div class="invalid-feedback">
                                {{ $errors->get('rooms')[0] }}
                            </div>
                        @endif
                    </div>

                    <div class="col">
                        <label for="field_beds" class="form-label">N° Letti</label>
                        <input type="number" min="1" max="20"
                            class="form-control {{ $errors->has('beds') ? 'is-invalid' : '' }}" name="beds"
                            id="field_beds" value="{{ old('beds') ?? $apartment->beds }}">

                        @if ($errors->has('beds'))
                            <div class="invalid-feedback">
                                {{ $errors->get('beds')[0] }}
                            </div>
                        @endif
                    </div>

                    <div class="col">
                        <label for="field_bathrooms" class="form-label">N° Bagni</label>
                        <input type="number" min="1" max="20"
                            class="form-control {{ $errors->has('bathrooms') ? 'is-invalid' : '' }}" name="bathrooms"
                            id="field_bathrooms" value="{{ old('bathrooms') ?? $apartment->bathrooms }}">

                        @if ($errors->has('bathrooms'))
                            <div class="invalid-feedback">
                                {{ $errors->get('bathrooms')[0] }}
                            </div>
                        @endif
                    </div>

                    <div class="col">
                        <label for="field_square_metres" class="form-label">Metri quadrati</label>
                        <input type="number" min="1" max="300"
                            class="form-control {{ $errors->has('square_metres') ? 'is-invalid' : '' }}"
                            name="square_metres" id="field_square_metres"
                            value="{{ old('square_metres') ?? $apartment->square_metres }}">

                        @if ($errors->has('square_metres'))
                            <div class="invalid-feedback">
                                {{ $errors->get('square_metres')[0] }}
                            </div>
                        @endif
                    </div>

                    <div class="col">
                        <label for="field_night_price" class="form-label">Prezzo per notte</label>
                        <input type="number" step="0.01" min="0" max="9999"
                            class="form-control {{ $errors->has('night_price') ? 'is-invalid' : '' }}" name="night_price"
                            id="field_night_price" value="{{ old('night_price') ?? $apartment->night_price }}">

                        @if ($errors->has('night_price'))
                            <div class="invalid-feedback">
                                {{ $errors->get('night_price')[0] }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-10 col-lg-8">
                <div class="form-label">Services</div>
                @foreach ($services as $service)
                    <label class="mx-2 my-2">
                        {{ $service->name }}
                        <input name="services[]" type="checkbox" value="{{ $service->id }}">
                    </label>
                @endforeach
                </select>
            </div>
    </div>

    <div class="col-12 col-md-10 col-lg-8 d-flex justify-content-center">
        {{-- STILI BUTTON DA DEFINIRE --}}
        <button type="submit" class="btn btn-primary">Modifica</button>
    </div>

    </form>
    </div>
@endsection
