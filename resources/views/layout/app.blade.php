<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>BSM | @yield('title')</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/img/icon_panjang.png') }}" alt=""
        sizes="16x16" />
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/loading.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dist/trix.css') }}">
    {{-- Bootsrap 5 --}}
    <link href="{{ asset('assets/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    {{-- Data Tables --}}
    <link rel="stylesheet" href="{{ url('plugins/datatables-bs4/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ url('plugins/datatables-responsive/css/responsive.bootstrap5.min.css') }}">
    {{-- Font Awesome --}}
    <link rel="stylesheet" href="{{ url('plugins/fontawesome/css/all.css') }}">
    {{-- Font Awesome --}}
    <link rel="stylesheet" href="{{ url('plugins/sweetalert/sweetalert2.min.css') }}">
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-FT25W7FVR5"></script>

</head>

<body>
    {{-- Loader --}}
    <div id="loading-container">
        <div id="loading" class="loading"></div>
    </div>
    {{-- Sidebar --}}
    @include('layout.sidebar')
    {{-- End Sidebar --}}
    <!-- End Sideber -->
    <section class="home_section">
        {{-- Topbar --}}
        @include('layout.topbar')
        {{-- End Topbar --}}
        {{-- Content --}}
        @yield('content')
        {{-- End Content --}}
    </section>
    {{-- Admin Main JS --}}
    <script src="{{ asset('assets/js/main.js') }}"></script>
    {{-- Bootstrap 5 --}}
    <script src="{{ asset('assets/dist/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/dist/js/bootstrap.min.js') }}"></script>
    {{-- Sweetalert --}}
    <script src="{{ asset('plugins/sweetalert/sweetalert2.all.min.js') }}"></script>
    {{-- Data Tables --}}
    <script src="{{ url('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('plugins/datatables-bs4/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ url('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ url('plugins/datatables-responsive/js/responsive.bootstrap5.min.js') }}"></script>
    @yield('script')
    {{-- Trix JS --}}
    <script src="{{ asset('assets/dist/trix.umd.min.js') }}"></script>
    <style>
        trix-toolbar [data-trix-button-group="file-tools"] {
            display: none;
        }
    </style>
    <script>
        document.addEventListener('trix-file-accept', function(e) {
            e.preventDefault();
        })
    </script>
    <script>
        function loading() {
            const loadingContainer = document.getElementById("loading-container");
            const loading = document.getElementById('loading');

            loadingContainer.style.display = "none";
            loadingContainer.classList.add("hidden");
        }
        window.addEventListener('load', loading);
    </script>

</body>

</html>
