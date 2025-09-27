<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') - Farmacia 701</title>

    @vite(['resources/css/app.css'])

    <meta name="csrf-token" content="{{ csrf_token() }}">


    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
    @vite(['resources/js/app.js']);
    @vite(['resources/js/components/sidebar.js', 'resources/js/components/header.js']);

    @stack('scripts')
</body>

</html>