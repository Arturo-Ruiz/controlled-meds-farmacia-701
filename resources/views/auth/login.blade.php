<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Iniciar Sesión | Farmacia 701</title>

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