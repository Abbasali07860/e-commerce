<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="author" content="Untree.co">
    <meta name="description" content="">
    <meta name="keywords" content="bootstrap, bootstrap4">
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}">

    <title>{{ config('app.name', 'Laravel') }} - @yield('title')</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <!-- CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('css/tiny-slider.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <!-- Custom Header with Navigation -->
        <x-header />

        <!-- Page Content -->
        <main class="">
            @yield('content')
        </main>

        <!-- Footer -->
        <x-footer />
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/tiny-slider.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
    <script src="{{ asset('js/subscribe.js') }}"></script>
</body>
@stack('scripts')
</html>