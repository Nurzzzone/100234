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
  @yield('header-scripts')
  {{--    <script src="{{ asset('js/app.js') }}" defer></script>--}}
  <script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-118965717-3"></script>

  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }

    gtag('js', new Date());
    gtag('config', 'UA-118965717-3');
    gtag('config', 'UA-118965717-5');
  </script>
  <link href="{{ asset('css/coreui-chartjs.css') }}" rel="stylesheet">
</head>

<body class="c-app">
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
      </div>
      @yield('content')
    </main>
    @include('shared.footer.index')
  </div>
</div>
@include('shared.scripts')
</body>
</html>
