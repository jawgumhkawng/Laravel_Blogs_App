<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    {{-- font awsome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />



    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        #card:hover {
            bottom: 2px;
            position: relative;
            transition: all 5s ease;
        }

        @media (min-width: 576px) {
            .img img {
                width: 220px;
                float: right;
                height: 220px;
            }

            .article-image img {
                height: 280px;
            }

        }

        @media (min-width: 1200px) {
            .article-image img {
                height: 330px;
            }
        }

        /* .bg-derk {
        background: linear-gradient(to top right, #000, #1c1917);
    } */
    </style>
</head>

<body class="bg-derk">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white  bg-derk shadow-sm "
            style="position: sticky; top:0px; z-index:4">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <b class="text-primary">jaw</b><b>{{ config('app.name', 'Laravel') }}</b>
                </a>
                <button class="navbar-toggler " type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    @auth
                        <ul class="navbar-nav me-auto">
                            <a href="{{ url('/articles/add') }}" title="Add Article" class="btn btn-sm btn-outline-primary"
                                data-toggle="tooltip" title="Hooray!"><i class="fa-solid fa-plus"></i> &nbsp;&nbsp; Add
                                New</a>
                        </ul>

                    @endauth
                    @guest
                        <ul class="navbar-nav me-auto">
                            <a href="#" class="text-primary fw-bold text-decoration-none" data-toggle="tooltip"
                                title="Hooray!">Hello {{ Request::segment(1) == 'admin' ? 'Admin' : 'User' }}</a>
                        </ul>
                    @endguest

                    @auth

                        <ul class="navbar-nav mt-3 mb-3 mt-lg-0 mb-lg-0">
                            <div class="{{ Request::segment(2) == 'detail' ? 'd-none' : '' }}">
                                <form class="d-flex" role="search" method="get">
                                    <input class="form-control " name="key" value="{{ request('key', '') }}"
                                        type="search" style="border-bottom-right-radius: 0px; border-top-right-radius: 0px"
                                        placeholder="Search" aria-label="Search">
                                    <button class="btn btn-sm btn-outline-primary" title="Search"
                                        style="border-bottom-left-radius: 0px; border-top-left-radius: 0px"
                                        type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                                </form>
                            </div>
                        </ul>

                    @endauth
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link btn btn-sm btn-primary py-1 px-2 active text-white me-lg-2 mb-1mb-lg-0 mt-2 mt-lg-0"
                                        href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link btn btn-sm btn-primary py-1 px-2 active text-white"
                                        href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown ">
                                {{-- <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a> --}}

                                {{-- <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown"> --}}
                                <a class="btn btn-sm btn-outline-primary" title="Logout" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}&nbsp; &nbsp;<i class="fa-solid fa-right-from-bracket"></i>
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                                {{-- </div> --}}
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')

        </main>

        <footer>
            <div class="">
                <h6 class="text-center text-muted">Copy Right <b class="text-danger">&copy;2023</b> All Right Reserved
                    by <b class="text-primary">mr.jaw</b></h6>
            </div>
        </footer>
    </div>
    <script>
        const exampleModal = document.getElementById('exampleModal')
        if (exampleModal) {
            exampleModal.addEventListener('show.bs.modal', event => {
                // Button that triggered the modal
                const button = event.relatedTarget
                // Extract info from data-bs-* attributes
                const recipient = button.getAttribute('data-bs-whatever')
                // If necessary, you could initiate an Ajax request here
                // and then do the updating in a callback.

                // Update the modal's content.
                const modalTitle = exampleModal.querySelector('.modal-title')
                const modalBodyInput = exampleModal.querySelector('.modal-body input')

                // modalTitle.textContent = `New message to ${recipient}`
                // modalBodyInput.value = recipient
            })
        }
    </script>
</body>

</html>
