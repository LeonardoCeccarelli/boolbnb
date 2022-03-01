@extends('layouts.app')
@section('page_title', 'Nuovo Appartamento - BollBnB')
@section('content')


<div class="container-fluid p-5">
    <div class="container p-5 shadow">
        <div class="mb-3 py-5 text-center">
            <h3 class="narrow-font mb-3">Inserisci un nuovo appartamento</h3>
        </div>

        <form class="admin-form" id="form_submit" action="{{ route('admin.apartment.store') }}"
            enctype="multipart/form-data" method="POST">
            @csrf

            <div class="row justify-content-center">

                {{-- TITOLO --}}
                <div class="col-12 col-md-10 col-lg-8 mb-5">
                    <label for="field_title" class="form-label narrow-font">Titolo</label>
                    <input type="text" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" name="title"
                        id="field_title" value="{{ old('title') }}">
                    @if ($errors->has('title'))
                    <div class="invalid-feedback">
                        {{ $errors->get('title')[0] }}
                    </div>
                    @endif
                </div>

                {{-- DESCRIZIONE --}}
                <div class="col-12 col-md-10 col-lg-8 mb-5">
                    <label class="form-label narrow-font">Descrizione</label>
                    <textarea type="text" rows="5"
                        class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"
                        name="description">{{ old('description') }}</textarea>
                    @if ($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->get('description')[0] }}
                    </div>
                    @endif
                </div>

                {{-- INDIRIZZO --}}
                <div class="col-12 col-md-10 col-lg-8 mb-5">
                    <div class="row">

                        {{-- VIA E N CIVICO --}}
                        <div class="col-7 me-5">
                            <label for="field_address" class="form-label narrow-font">Indirizzo</label>
                            <input type="text" class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}"
                                name="address" id="field_address" value="{{ old('address') }}">
                        </div>

                        {{-- CITTA --}}
                        <div class="col">
                            <label for="field_city" class="form-label narrow-font">Città</label>
                            <input type="text" class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}"
                                name="city" id="field_city" value="{{ old('city') }}">
                        </div>

                    </div>
                </div>

                {{-- IMMAGINE --}}
                <div class="col-12 col-md-10 col-lg-8 mb-5">
                    <label for="field_cover_img" class="form-label narrow-font">Link Immagine</label>
                    <input type="file" class="form-control {{ $errors->has('cover_img') ? 'is-invalid' : '' }}"
                        name="cover_img" id="field_cover_img" value="{{ old('cover_img') }}">
                    @if ($errors->has('cover_img'))
                    <div class="invalid-feedback">
                        {{ $errors->get('cover_img')[0] }}
                    </div>
                    @endif
                </div>

                {{-- CARATTERISTICHE --}}
                <div class="col-12 col-md-10 col-lg-8 mb-5 mb-md-0">

                    <div class="row row-cols-2 row-cols-md-4 align-items-baseline">
                        {{-- STANZE --}}
                        <div class="col mb-5">
                            <label for="field_rooms" class="form-label">N° Stanze</label>
                            <input type="number" min="1" max="20"
                                class="form-control input-70{{ $errors->has('rooms') ? 'is-invalid' : '' }}"
                                name="rooms" id="field_rooms" value="{{ old('rooms') }}">
                            @if ($errors->has('rooms'))
                            <div class="invalid-feedback">
                                {{ $errors->get('rooms')[0] }}
                            </div>
                            @endif
                        </div>

                        {{-- LETTI --}}
                        <div class="col">
                            <label for="field_beds" class="form-label">N° Letti</label>
                            <input type="number" min="1" max="20"
                                class="form-control  input-70 {{ $errors->has('beds') ? 'is-invalid' : '' }}"
                                name="beds" id="field_beds" value="{{ old('beds') }}">
                            @if ($errors->has('beds'))
                            <div class="invalid-feedback">
                                {{ $errors->get('beds')[0] }}
                            </div>
                            @endif
                        </div>

                        {{-- BAGNI --}}
                        <div class="col">
                            <label for="field_bathrooms" class="form-label">N° Bagni</label>
                            <input type="number" min="1" max="20"
                                class="form-control  input-70 {{ $errors->has('bathrooms') ? 'is-invalid' : '' }}"
                                name="bathrooms" id="field_bathrooms" value="{{ old('bathrooms') }}">
                            @if ($errors->has('bathrooms'))
                            <div class="invalid-feedback">
                                {{ $errors->get('bathrooms')[0] }}
                            </div>
                            @endif
                        </div>

                        {{-- METRI QUADRI --}}
                        <div class="col">
                            <label for="field_square_metres" class="form-label">Metri quadrati</label>
                            <input type="number" min="1" max="1000"
                                class="form-control input-70 {{ $errors->has('square_metres') ? 'is-invalid' : '' }}"
                                name="square_metres" id="field_square_metres" value="{{ old('square_metres') }}">
                            @if ($errors->has('square_metres'))
                            <div class="invalid-feedback">
                                {{ $errors->get('square_metres')[0] }}
                            </div>
                            @endif
                        </div>

                    </div>
                </div>

                {{-- PREZZO --}}
                <div class="col-12 col-md-10 col-lg-8 mb-5">
                    <label for="field_night_price" class="form-label">Prezzo per notte</label>
                    <input type="number" step="0.01" min="0" max="9999"
                        class="form-control  input-150 {{ $errors->has('night_price') ? 'is-invalid' : '' }}"
                        name="night_price" id="field_night_price" value="{{ old('night_price') }}">
                    @if ($errors->has('night_price'))
                    <div class="invalid-feedback">
                        {{ $errors->get('night_price')[0] }}
                    </div>
                    @endif
                </div>
                {{-- SERVIZI --}}
                <div class="col-12 col-md-10 col-lg-8 mb-5">

                    <label class="form-label narrow-font">Servizi:</label>
                    @foreach ($services as $service)
                    <label class="mx-2 my-2">
                        {{ $service->name }}
                        <input class="form-check-input ms-1" name="services[]" type="checkbox"
                            value="{{ $service->id }}">
                    </label>
                    @endforeach
                    </select>
                </div>

                {{-- VISIBILITY --}}
                <div class="col-12 col-md-10 col-lg-8 mb-5">
                    <div class="form-check form-switch">
                        <input class="form-check-input" name="visible" type="checkbox" role="switch"
                            id="flexSwitchCheckChecked" checked>
                        <label class="form-check-label narrow-font" for="flexSwitchCheckChecked ">Visibile</label>
                    </div>
                </div>


                <div class="col-12 col-md-10 col-lg-8 mb-5 text-center">
                    {{-- STILI BUTTON DA DEFINIRE --}}
                    <button type="submit" class="mx-2 btn button_4">Aggiungi</button>
                </div>

            </div>
        </form>
    </div>
</div>
</div>
@endsection