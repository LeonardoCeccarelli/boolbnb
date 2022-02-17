@extends('layouts.app')

@section('page_title', 'Nuovo Appartamento - BollBnB')

@section('content')
<div class="container">
    <div class="mb-5 pb-5 text-center">
        <h2>Ciao {{ Auth::user()->first_name }}</h2>
        <h4>In questa sezione puoi inserire un nuovo appartamento</h4>
    </div>
    <form id="form_submit" action="{{ route('admin.apartment.store') }}" enctype="multipart/form-data" method="POST"
        class="row justify-content-center gy-5">
        @csrf

        {{-- Toggle Visibility --}}
        <div class="col-8">
            <div class="form-check form-switch">
                <input class="form-check-input" name="visible" type="checkbox" role="switch" id="flexSwitchCheckChecked"
                    value="visible" checked>
                <label class="form-check-label" for="flexSwitchCheckChecked">Visibile</label>
            </div>
        </div>

        {{-- Title --}}
        <div class="col-12 col-md-10 col-lg-8">
            <label for="field_title" class="form-label">Titolo</label>
            <input type="text" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" name="title"
                id="field_title" value="{{ old('title') }}">

            @if ($errors->has('title'))
            <div class="invalid-feedback">
                {{ $errors->get('title')[0] }}
            </div>
            @endif
        </div>

        {{-- Description --}}
        <div class="col-12 col-md-10 col-lg-8">
            <label class="form-label">Descrizione</label>
            <textarea type="text" rows="5" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"
                name="description">{{ old('description') }}</textarea>

            @if ($errors->has('description'))
            <div class="invalid-feedback">
                {{ $errors->get('description')[0] }}
            </div>
            @endif
        </div>

        {{-- Address --}}
        <div class="col-12 col-md-10 col-lg-8">
            <label for="field_address" class="form-label">Indirizzo</label>
            <input type="text" class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" name="address"
                id="field_address" value="{{ old('address') }}">
        </div>

        {{-- City --}}
        <div class="col-12 col-md-10 col-lg-8">
            <label for="field_city" class="form-label">Città</label>
            <input type="text" class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}" name="city"
                id="field_city" value="{{ old('city') }}">
        </div>

        <input id="field_lat" hidden type="text" value="" name="lat">
        <input id="field_lon" hidden type="text" value="" name="lon">

        {{-- Cover_Img --}}
        <div class="col-12 col-md-10 col-lg-8">
            <label for="field_cover_img" class="form-label">Link Immagine</label>
            <input type="file" class="form-control {{ $errors->has('cover_img') ? 'is-invalid' : '' }}" name="cover_img"
                id="field_cover_img" value="{{ old('cover_img') }}">

            @if ($errors->has('cover_img'))
            <div class="invalid-feedback">
                {{ $errors->get('cover_img')[0] }}
            </div>
            @endif
        </div>

        {{-- Rooms Number --}}
        <div class="col-12 col-md-10 col-lg-8">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-xl-5 g-3">
                <div class="col">
                    <label for="field_rooms" class="form-label">N° Stanze</label>
                    <input type="number" min="1" max="20"
                        class="form-control {{ $errors->has('rooms') ? 'is-invalid' : '' }}" name="rooms"
                        id="field_rooms" value="{{ old('rooms') }}">

                    @if ($errors->has('rooms'))
                    <div class="invalid-feedback">
                        {{ $errors->get('rooms')[0] }}
                    </div>
                    @endif

                    {{-- Description --}}
                    <div class="col-12 col-md-10 col-lg-8">
                        <label class="form-label fw-bold fs-4">Descrizione</label>
                        <textarea type="text" rows="5"
                            class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"
                            name="description">{{ old('description') }}</textarea>

                        @if ($errors->has('description'))
                        <div class="invalid-feedback">
                            {{ $errors->get('description')[0] }}
                        </div>
                        @endif
                    </div>

                    {{-- Address --}}
                    <div class="col-12 col-md-10 col-lg-8">
                        <label for="field_address" class="form-label fw-bold fs-4">Indirizzo</label>
                        <input type="text" class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}"
                            name="address" id="field_address" value="{{ old('address') }}">
                    </div>

                    {{-- City --}}
                    <div class="col-12 col-md-10 col-lg-8">
                        <label for="field_city" class="form-label fw-bold fs-4">Città</label>
                        <input type="text" class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}"
                            name="city" id="field_city" value="{{ old('city') }}">
                    </div>

                    <input id="field_lat" hidden type="text" value="" name="lat">
                    <input id="field_lon" hidden type="text" value="" name="lon">

                    {{-- Cover_Img --}}
                    <div class="col-12 col-md-10 col-lg-8">
                        <label for="field_cover_img" class="form-label fw-bold fs-4">Link Immagine</label>
                        <input type="file" class="form-control {{ $errors->has('cover_img') ? 'is-invalid' : '' }}"
                            name="cover_img" id="field_cover_img" value="{{ old('cover_img') }}">

                        @if ($errors->has('cover_img'))
                        <div class="invalid-feedback">
                            {{ $errors->get('cover_img')[0] }}
                        </div>
                        @endif
                    </div>

                    {{-- Rooms Number --}}
                    <div class="col-12 col-md-10 col-lg-8">
                        <div class="form-label fw-bold fs-4">Ulteriori Informazioni:</div>
                        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-xl-5 g-3">
                            <div class="col">
                                <label for="field_rooms" class="form-label">N° Stanze</label>
                                <input type="number" min="1" max="20"
                                    class="form-control {{ $errors->has('rooms') ? 'is-invalid' : '' }}" name="rooms"
                                    id="field_rooms" value="{{ old('rooms') }}">

                                @if ($errors->has('rooms'))
                                <div class="invalid-feedback">
                                    {{ $errors->get('rooms')[0] }}
                                </div>
                                @endif
                            </div>

                            {{-- Beds Number --}}
                            <div class="col">
                                <label for="field_beds" class="form-label">N° Letti</label>
                                <input type="number" min="1" max="20"
                                    class="form-control {{ $errors->has('beds') ? 'is-invalid' : '' }}" name="beds"
                                    id="field_beds" value="{{ old('beds') }}">

                                @if ($errors->has('beds'))
                                <div class="invalid-feedback">
                                    {{ $errors->get('beds')[0] }}
                                </div>
                                @endif
                            </div>

                            {{-- Bathrooms Number --}}
                            <div class="col">
                                <label for="field_bathrooms" class="form-label">N° Bagni</label>
                                <input type="number" min="1" max="20"
                                    class="form-control {{ $errors->has('bathrooms') ? 'is-invalid' : '' }}"
                                    name="bathrooms" id="field_bathrooms" value="{{ old('bathrooms') }}">

                                @if ($errors->has('bathrooms'))
                                <div class="invalid-feedback">
                                    {{ $errors->get('bathrooms')[0] }}
                                </div>
                                @endif
                            </div>

                            {{-- Square_Metres --}}
                            <div class="col">
                                <label for="field_square_metres" class="form-label">Metri quadrati</label>
                                <input type="number" min="1" max="1000"
                                    class="form-control {{ $errors->has('square_metres') ? 'is-invalid' : '' }}"
                                    name="square_metres" id="field_square_metres" value="{{ old('square_metres') }}">

                                @if ($errors->has('square_metres'))
                                <div class="invalid-feedback">
                                    {{ $errors->get('square_metres')[0] }}
                                </div>
                                @endif
                            </div>

                            {{-- Price_per_Night --}}
                            <div class="col">
                                <label for="field_night_price" class="form-label">Prezzo per notte</label>
                                <input type="number" step="0.01" min="0" max="9999"
                                    class="form-control {{ $errors->has('night_price') ? 'is-invalid' : '' }}"
                                    name="night_price" id="field_night_price" value="{{ old('night_price') }}">

                                @if ($errors->has('night_price'))
                                <div class="invalid-feedback">
                                    {{ $errors->get('night_price')[0] }}
                                </div>
                                @endif
                            </div>
                        </div>

                    </div>


                    {{-- Services --}}
                    <div class="col-12 col-md-10 col-lg-8">
                        {{-- <label for="field_services" class="form-label">Servizi</label>
                        <small class="text-secondary mb-0 ms-3 pt-1 d-inline-block">Hold down the Ctrl (windows) or
                            Command
                            (Mac) button to select multiple options.</small>
                        <select multiple class="form-control" name="services[]" id="field_services"> --}}
                            <div class="form-label fw-bold fs-4">Servizi:</div>
                            @foreach ($services as $service)
                            <label class="mx-2 my-2">
                                {{ $service->name }}
                                <input name="services[]" type="checkbox" value="{{ $service->id }}">
                            </label>
                            @endforeach
                        </select>
                    </div>
                    {{-- Toggle Visibility --}}
                    <div class="col-8">
                        <div class="form-check form-switch">
                            <label class="form-check-label fw-bold" for="flexSwitchCheckChecked ">Visibile</label>
                            <input class="form-check-input" name="visible" type="checkbox" role="switch"
                                id="flexSwitchCheckChecked" value="visible" checked>
                        </div>
                    </div>


                    <div class="col-12 col-md-10 col-lg-8 d-flex justify-content-center">
                        {{-- STILI BUTTON DA DEFINIRE --}}
                        <button type="submit" class="btn btn-primary text-white">Aggiungi</button>
                    </div>


    </form>
</div>

</div>
</div>