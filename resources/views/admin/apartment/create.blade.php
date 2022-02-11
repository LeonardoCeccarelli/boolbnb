@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{ route('admin.apartment.store') }}" enctype="multipart/form-data" method="POST"
        class="d-flex align-items-center flex-column mb-5">
        @csrf

        <div class="mb-4 w-75">
            <label for="field_title" class="form-label">Titolo</label>
            <input type="text" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" name="title"
                id="field_title" value="{{ old('title') }}">

            @if($errors->has("title"))
            <div class="invalid-feedback">
                {{ $errors->get("title")[0]}}
            </div>
            @endif
        </div>

        <div class="mb-4 w-75">
            <label class="form-label">Descrizione</label>
            <textarea type="text" rows="5" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"
                name="description">{{ old("description") }}</textarea>

            @if($errors->has("description"))
            <div class="invalid-feedback">
                {{ $errors->get("description")[0]}}
            </div>
            @endif
        </div>

        <div class="mb-4 w-75">
            <label for="field_cover_img" class="form-label">Link Immagine</label>
            <input type="file" class="form-control {{ $errors->has('cover_img') ? 'is-invalid' : '' }}" name="cover_img"
                id="field_cover_img" value="{{ old('cover_img') }}">

            @if($errors->has("cover_img"))
            <div class="invalid-feedback">
                {{ $errors->get("cover_img")[0]}}
            </div>
            @endif
        </div>

        <div class="d-flex justify-content-between w-75 mb-4">
            <div>
                <label for="field_rooms" class="form-label">N° Stanze</label>
                <input type="number" min="1" max="20"
                    class="form-control {{ $errors->has('rooms') ? 'is-invalid' : ''}}" name="rooms" id="field_rooms"
                    value="{{ old('rooms') }}">

                @if($errors->has("rooms"))
                <div class="invalid-feedback">
                    {{ $errors->get("rooms")[0]}}
                </div>
                @endif
            </div>

            <div>
                <label for="field_beds" class="form-label">N° Letti</label>
                <input type="number" min="1" max="20" class="form-control {{ $errors->has('beds') ? 'is-invalid' : ''}}"
                    name="beds" id="field_beds" value="{{ old('beds') }}">

                @if($errors->has("beds"))
                <div class="invalid-feedback">
                    {{ $errors->get("beds")[0]}}
                </div>
                @endif
            </div>

            <div>
                <label for="field_bathrooms" class="form-label">N° Bagni</label>
                <input type="number" min="1" max="20"
                    class="form-control {{ $errors->has('bathrooms') ? 'is-invalid' : ''}}" name="bathrooms"
                    id="field_bathrooms" value="{{ old('bathrooms') }}">

                @if($errors->has("bathrooms"))
                <div class="invalid-feedback">
                    {{ $errors->get("bathrooms")[0]}}
                </div>
                @endif
            </div>

            <div>
                <label for="field_square_metres" class="form-label">Metri quadrati</label>
                <input type="number" min="1" max="300"
                    class="form-control {{ $errors->has('square_metres') ? 'is-invalid' : ''}}" name="square_metres"
                    id="field_square_metres" value="{{ old('square_metres') }}">

                @if($errors->has("square_metres"))
                <div class="invalid-feedback">
                    {{ $errors->get("square_metres")[0]}}
                </div>
                @endif
            </div>

            <div>
                <label for="field_night_price" class="form-label">Prezzo per notte</label>
                <input type="number" step="0.01" min="0" max="9999"
                    class="form-control {{ $errors->has('night_price') ? 'is-invalid' : ''}}" name="night_price"
                    id="field_night_price" value="{{ old('night_price') }}">

                @if($errors->has("night_price"))
                <div class="invalid-feedback">
                    {{ $errors->get("night_price")[0]}}
                </div>
                @endif
            </div>
        </div>

        <div class="form-group">
            <label for="field_services" class="form-label">Servizi</label>
            <small class="text-secondary mb-0 ml-3 pt-1 d-inline-block">Hold down the Ctrl (windows) or Command
                (Mac) button to select multiple options.</small>
            <select multiple class="form-control" name="services[]" id="field_services">
                @foreach ($services as $service)
                <option value="{{ $service->id }}">{{ $service->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4 w-75">
            <label for="field_user" class="form-label">Autore</label>
            <input type="text" class="form-control" id="field_user"
                value="{{ Auth::user()->first_name }}  {{ Auth::user()->last_name }}" readonly>
        </div>

        <div>
            <button type="submit" class="btn btn-primary">Aggiungi</button>
        </div>

    </form>
</div>

<script src="//js.nicedit.com/nicEdit-latest.js" type="text/javascript">
</script>
<script type="text/javascript">
    bkLib.onDomLoaded(nicEditors.allTextAreas);
</script>
@endsection