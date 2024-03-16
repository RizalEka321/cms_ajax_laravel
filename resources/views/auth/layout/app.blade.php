<!DOCTYPE html>
<html lang="en">

<head>
    <title>BSM|@yield('title')</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" type="image/png" href="{{ asset('assets/img/icon_panjang.png') }}" alt="" sizes="16x16" />
    {{-- Bootstrap 5 --}}
    <link href="{{ asset('assets/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="assets/fonts/Linearicons-Free-v1.0.0/icon-font.min.css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/animate/animate.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/css-hamburgers/hamburgers.min.css') }}" />
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('plugins/animsition/css/animsition.min.css') }}" /> --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/select2/select2.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/util.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/auth.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/loading.css') }}">
</head>

<body>
    {{-- Loader --}}
    <div id="loading-container">
        <div id="loading" class="loading"></div>
    </div>
    @yield('content')
    {{-- <script src="{{ asset('plugins/animsition/js/animsition.min.js') }}"></script> --}}
    <script src="{{ asset('assets/dist/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('plugins/daterangepicker/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('plugins/countdowntime/countdowntime.js') }}"></script>
    <script src="{{ asset('assets/js/auth.js') }}"></script>
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
