<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Sistema de medicamentos controlados | Farmacia 701</title>

    <link rel="icon" type="image/png" href="{{ asset('/favicon-96x96.png') }}" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="{{ asset('/favicon.svg') }}" />
    <link rel="shortcut icon" href="{{ asset('/favicon.ico') }}" />
    <link rel="apple-touch-icon" sizes="180x180" href=" {{ asset('/apple-touch-icon.png') }} " />
    <meta name="apple-mobile-web-app-title" content="Farmacia 701" />
    <link rel="manifest" href="{{ asset('/site.webmanifest') }}" />

    <!-- SEO Meta Tags -->
    <meta name="description" content="Sistema de Medicamentos Controlados - Farmacia 701 - ¡Somos tus Aliados en Salud!. Ubicada en Ciudad Bolívar con servicio de entrega a domicilio. Encuentra medicamentos, productos de salud, cuidado personal y suplementos deportivos.">

    <meta name="keywords" content="Farmacia, Medicina, Médico, Medicamentos, Salud, Remedio, Farmacia en Ciudad Bolívar, medicamentos Ciudad Bolívar, farmacia cerca de mí, servicio de farmacia a domicilio, entrega de medicamentos Ciudad Bolívar, venta de medicamentos, medicinas Ciudad Bolívar, consultas farmacéuticas, asesoría farmacéutica, vitaminas, productos de cuidado personal, productos de salud, farmacias abiertas Ciudad Bolívar, remedios Ciudad Bolívar, productos naturales, salud Ciudad Bolívar, higiene personal, productos de bebé, suplementos alimenticios">

    <meta name="author" content="Arturo Ruiz">

    <meta name="robots" content="index, follow">

    <link rel="canonical" href="{{ url()->current() }}">

    @vite(['resources/css/app.css'])

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- Auth Component Styles -->
    @vite(['resources/css/components/auth/login.css'])
</head>

<body class="min-h-screen bg-gradient-to-br from-blue-100 to-blue-200 flex items-center justify-center p-4 relative overflow-hidden" style="font-family: 'Inter', sans-serif;">

    <!-- Background Component -->
    <x-auth.animated-background />

    <!-- Login Form Component -->
    <x-auth.login-form />

    <!-- Auth Scripts -->
    @vite(['resources/js/components/auth/login.js'])
</body>

</html>