@extends('layouts.app')

@section('page_title', 'Login | BoolBnB')

@section('content')

    <style>
        .bg-image {
            background-image: url("/img/login_bg.jpg");
        }
   </style>
   
   <div class="auth">
    <div class="bg-image bg-format container-fluid ">
        <div class="container p-5">
            <div class="row justify-content-center text-center text-white">
                <div class="col-12 col-md-10 col-lg-6">
                    <div class="card p-5" style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
                        <div class="card-body">
                            <h3 class="mb-5" style="color: black;">Ti diamo il benvenuto su Boolbnb</h3>
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="form-group row text-dark text-start d-flex justify-content-center mb-3">
                                    <label for="email"
                                        class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                                    <div class="col-md-8">
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
                                <div class="form-group row text-dark text-start  d-flex justify-content-center mb-3">
                                    <label for="password"
                                        class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                                    <div class="col-md-8 ">
                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            required autocomplete="current-password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row text-dark text-start mb-4">
                                    <div class="col-md-6 offset-md-4">
                                        <div class="form-check ">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                                {{ old('remember') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="remember">
                                                {{ __('Remember Me') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-0 d-flex justify-content-center ">
                                    <div class="col-md-8 mb-2">
                                        <button type="submit" class="button button_2 mb-3">
                                            {{ __('Login') }}
                                        </button>
                                    </div>
                                    <div class="col-md-8 ">
                                        @if (Route::has('password.request'))
                                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                        @endif
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
