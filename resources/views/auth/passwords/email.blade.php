@extends('layouts.app')

@section('page_title', 'Reset | BoolBnB')

@section('content')

    <style>
        .bg-image {
            background-image: url("/img/login_bg.jpg");
        }

    </style>
    
<div class="auth">
    <div class="bg-image bg-format container-fluid py-5">
        <div class="container py-5">
            <div class="row justify-content-center text-center">
                <div class="col-10 col-lg-6">
                    <div class="card p-4">
                        <div class="card-body">
                            <h3 class="mb-5">Inserisci il tuo indirizzo email</h3>
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf
                                <div class="form-group row mb-4">
                                    <label for="email"
                                        class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                                    <div class="col-md-6">
                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" required autocomplete="email" autofocus>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-0 d-flex justify-content-center">
                                    <div class="col-md-6 mb-2">
                                        <button type="submit" class="button button_2 my-3">
                                            {{ __('Send Password') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
