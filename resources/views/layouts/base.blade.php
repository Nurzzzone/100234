<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link href="{{ asset('css/free.min.css') }}" rel="stylesheet"> {{-- icons --}}
    <link href="{{ asset('css/flag.min.css') }}" rel="stylesheet"> {{-- icons --}}
    <link href="{{ asset('css/style.css') }}" rel="stylesheet"> {{-- styles --}}
    @yield('css')
    <script>
        window.addEventListener('load', function() {
            document.getElementById('global-loader').style.setProperty('display', 'none', 'important');
        })
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    @yield('header-scripts')
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>

<body>
    <div id="global-loader" class="global-loader-wrapper position-absolute d-flex justify-content-center align-items-center flex-column">
        <div class="global-loader"></div>
        <span class="global-loader-text font-lg mt-4">Пожалуйста подождите осталось совсем немного</span>
    </div>
    <div class="c-app" id="app">
        <div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
            @include('shared.sidebar.brand')
            @include('shared.sidebar.nav-builder')
        </div>

        <div class="c-wrapper">
            @include('shared.header.index')
            <div class="c-body">
                <main class="c-main">
                    <div class="container-fluid">
                        @include('partials.flash-message')
                        @include('partials.validation')
                    </div>
                    @yield('content')
                </main>
                @include('shared.footer.index')
            </div>
        </div>
    </div>

@include('shared.scripts')
</body>
</html>
