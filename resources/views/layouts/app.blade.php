<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<style>
    nav .black {
        color: black !important;
    }

    nav .dropdown-menu {
        position: absolute !important;
        border: none !important;
        min-width: 100px !important;
    }

    nav .far {
        font-size: 25px;
    }
</style>
@include('partials.head')

<body>
    {{-- NAVBAR --}}
    <nav class="navbar navbar-expand-md navbar-light bg-white">
        <div class="container px-5">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img class="w-50 d-none d-md-block" src="/img/full_logo.png" alt="boolbnb logo">
                <img class="w-50 d-block d-md-none" src="/img/logo.png" alt="">
            </a>
            <div id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto">
                    <!-- Authentication Links -->
                    @guest
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link black" href="#" role="button" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false" v-pre>
                            <i class="far fa-user me-1"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('login') }}">
                                {{ __('Login') }}
                            </a>
                            <a class="dropdown-item" href="{{ route('register') }}">
                                {{ __('Register') }}
                            </a>
                        </div>
                    </li>
                    @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle black" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('admin.home') }}">
                                Dashboard
                            </a>
                            <a class="dropdown-item" href="{{ route('admin.message.index') }}">
                                Messaggi
                            </a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                                        document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
    <main>
        @yield('content')
    </main>
    @include('partials.the_footer')
    @yield('scripts')
</body>

</html>