<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Panel de control') - Farmacia 701</title>

    <link rel="icon" type="image/png" href="{{ asset('/favicon-96x96.png') }}" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="{{ asset('/favicon.svg') }}" />
    <link rel="shortcut icon" href="{{ asset('/favicon.ico') }}" />
    <link rel="apple-touch-icon" sizes="180x180" href=" {{ asset('/apple-touch-icon.png') }} " />
    <meta name="apple-mobile-web-app-title" content="Farmacia 701" />
    <link rel="manifest" href="{{ asset('/site.webmanifest') }}" />

    <!-- SEO Meta Tags -->
    <meta name="description" content="Sistema de medicamentos controlados - Farmacia 701 - ¡Somos tus Aliados en Salud!. Ubicada en Ciudad Bolívar con servicio de entrega a domicilio. Encuentra medicamentos, productos de salud, cuidado personal y suplementos deportivos.">

    <meta name="keywords" content="Farmacia, Medicina, Médico, Medicamentos, Salud, Remedio, Farmacia en Ciudad Bolívar, medicamentos Ciudad Bolívar, farmacia cerca de mí, servicio de farmacia a domicilio, entrega de medicamentos Ciudad Bolívar, venta de medicamentos, medicinas Ciudad Bolívar, consultas farmacéuticas, asesoría farmacéutica, vitaminas, productos de cuidado personal, productos de salud, farmacias abiertas Ciudad Bolívar, remedios Ciudad Bolívar, productos naturales, salud Ciudad Bolívar, higiene personal, productos de bebé, suplementos alimenticios">

    <meta name="author" content="Arturo Ruiz">

    <meta name="robots" content="index, follow">

    <link rel="canonical" href="{{ url()->current() }}">

    @vite(['resources/css/app.css'])

    <meta name="csrf-token" content="{{ csrf_token() }}">


    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Component Styles -->
    @vite(['resources/css/components/sidebar.css', 'resources/css/components/animations.css'])
</head>

<body class="bg-gradient-to-br from-gray-50 via-blue-50/30 to-indigo-50/20 font-inter overflow-x-hidden">
    <!-- Sidebar Component -->
    <x-layout.sidebar />

    <!-- Main Content -->
    <div class="lg:ml-72 min-h-screen">
        <!-- Header Component -->
        <x-layout.header />

        <!-- Main Content Area -->
        <main class="p-6">
            @yield('content')
        </main>
    </div>

    <!-- Overlay Component -->
    <x-layout.overlay />

    <!-- Component Scripts -->
    @vite(['resources/js/app.js'])
    @vite(['resources/js/components/sidebar.js', 'resources/js/components/header.js'])

    @stack('scripts')
</body>

</html>