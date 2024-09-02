<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Diagnosa Penyakit dengan menggunakan Certain Factor</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,700,800&display=swap" rel="stylesheet">
    <link href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/font-awesome/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/perfectscroll/perfect-scrollbar.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/apexcharts/apexcharts.css') }}" rel="stylesheet">


    <!-- Theme Styles -->
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">

    <style>
        .sticky-notification {
            position: -webkit-sticky;
            /* For Safari */
            position: sticky;
            top: 0;
            width: 100%;
            background-color: #f8d7da;
            /* Light red background */
            color: #721c24;
            /* Dark red text */
            padding: 10px;
            text-align: center;
            z-index: 1000;
            /* Ensures it stays on top of other content */
            border-bottom: 1px solid #f5c6cb;
            /* Red border */
        }

        .notification-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .close-button {
            background: none;
            border: none;
            font-size: 1.5rem;
            color: #721c24;
            cursor: pointer;
        }
    </style>

    <!-- Scripts -->
    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}
</head>

<body>
    <div id="sticky-notification" class="sticky-notification">
        <div class="notification-content">
            <span>Ini adalah website demo sistem pakar diagnosa penyakit menggunakan metode Certain factor. beberapa
                menu tidak dapat diakses dalam mode demo ini. untuk pemesanan dan informasi lebih lanjut, silahkan <a
                    target="_blank" href="https://wa.me/62{{ config('general.phone') }}">Hubungi admin</a></span>
        </div>
    </div>
    <div id="app">
        <div class="page-container">
            @auth
                @include('partials.navbar')
            @endauth
            <div class="page-content">
                <div class="main-wrapper">
                    <div class="container">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>

        <script src="{{ asset('assets/plugins/jquery/jquery-3.4.1.min.js') }}"></script>
        <script src="https://unpkg.com/@popperjs/core@2"></script>
        <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
        <script src="https://unpkg.com/feather-icons"></script>
        <script src="{{ asset('assets/plugins/perfectscroll/perfect-scrollbar.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/apexcharts/apexcharts.min.js') }}"></script>
        <script src="{{ asset('assets/js/main.min.js') }}"></script>
        <script src="{{ asset('assets/js/pages/dashboard.js') }}"></script>

        @stack('script')


</body>

</html>
