<!-- NOTE: Plantilla predeterminada sobre el diseño de la web-->
<!-- NOTE: layouts.web-->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;900&display=swap">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <link rel="icon" href="{{ asset('Proyectos.png')}}">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Store - @yield('title')</title>
        @vite(['resources/css/app.css','resources/js/app.js',])
    </head>
    <body>
        <main>
            @include('includes.dashboard')

            @yield('content-dashboard')
            @yield('content-sales')
            @yield('content-supplies')
            @yield('content-products')
            @yield('content-paymentmethod')
            @yield('content-offers')
        </main>

        @include('includes.alerts')
        @include('includes.footer')
    </body>
</html>
