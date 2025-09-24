<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login - {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>

<body class="min-h-screen bg-gradient-to-br from-blue-100 via-blue-50 to-gray-100 flex items-center justify-center p-4 relative overflow-hidden" style="font-family: 'Inter', sans-serif;">
    <!-- Animated Background Elements -->
    <div class="absolute inset-0 overflow-hidden">
        <!-- Large geometric shapes -->
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-[#0077cc]/10 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-[#0077cc]/5 rounded-full blur-3xl animate-pulse" style="animation-delay: 2s;"></div>
        <div class="absolute top-1/2 left-1/4 w-32 h-32 bg-[#0077cc]/8 rounded-full blur-2xl animate-bounce" style="animation-duration: 6s;"></div>

        <!-- Grid pattern overlay -->
        <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width=" 40" height="40" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg" %3E%3Cg fill="%230077cc" fill-opacity="0.03" %3E%3Cpath d="M0 0h40v40H0z" /%3E%3Cpath d="M0 20h40M20 0v40" stroke="%230077cc" stroke-opacity="0.05" stroke-width="1" /%3E%3C/g%3E%3C/svg%3E')] opacity-40"></div>

        <!-- Floating particles -->
        <div class="absolute top-1/4 right-1/3 w-2 h-2 bg-[#0077cc]/20 rounded-full animate-ping" style="animation-delay: 1s;"></div>
        <div class="absolute bottom-1/3 left-1/5 w-3 h-3 bg-[#0077cc]/15 rounded-full animate-ping" style="animation-delay: 3s;"></div>
        <div class="absolute top-2/3 right-1/4 w-1 h-1 bg-[#0077cc]/25 rounded-full animate-ping" style="animation-delay: 5s;"></div>
    </div>

    <!-- Login Container -->
    <div class="relative w-full max-w-md z-10">
        <!-- Main Card with enhanced backdrop -->
        <div class="bg-white/95 backdrop-blur-sm border border-white/50 rounded-2xl shadow-2xl p-8 relative overflow-hidden">
            <!-- Subtle gradient overlay -->
            <div class="absolute inset-0 bg-gradient-to-br from-[#0077cc]/5 via-transparent to-blue-50/30 rounded-2xl"></div>

            <!-- Content -->
            <div class="relative z-10">
                <!-- Logo/Icon -->
                <div class="text-center mb-8">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-[#0077cc] to-blue-600 rounded-xl mb-4 shadow-lg">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                    <h1 class="text-2xl font-bold text-gray-800 mb-2">Panel Administrativo</h1>
                    <p class="text-gray-600 text-sm">Farmacia 701 - Sistema de Control</p>
                </div>

                <!-- Login Form -->
                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <!-- Email Field -->
                    <div class="space-y-2">
                        <label for="email" class="block text-sm font-medium text-gray-700">
                            Correo Electrónico
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                </svg>
                            </div>
                            <input type="email" name="email" id="email" required
                                class="block w-full pl-10 pr-3 py-3 bg-white/80 backdrop-blur-sm border border-gray-200 rounded-xl text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#0077cc] focus:border-transparent focus:bg-white transition duration-200"
                                placeholder="admin@farmacia701.com"
                                value="{{ old('email') }}">
                        </div>
                        @error('email')
                        <p class="text-red-500 text-sm flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <!-- Password Field -->
                    <div class="space-y-2">
                        <label for="password" class="block text-sm font-medium text-gray-700">
                            Contraseña
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <input type="password" name="password" id="password" required
                                class="block w-full pl-10 pr-3 py-3 bg-white/80 backdrop-blur-sm border border-gray-200 rounded-xl text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#0077cc] focus:border-transparent focus:bg-white transition duration-200"
                                placeholder="••••••••••••">
                        </div>
                        @error('password')
                        <p class="text-red-500 text-sm flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="flex items-center justify-between">
                        <label class="flex items-center">
                            <input type="checkbox" name="remember"
                                class="w-4 h-4 text-[#0077cc] bg-white border-gray-300 rounded focus:ring-[#0077cc] focus:ring-2">
                            <span class="ml-2 text-sm text-gray-600">Recordarme</span>
                        </label>
                        <a href="#" class="text-sm text-[#0077cc] hover:text-blue-800 transition duration-200">
                            ¿Olvidaste tu contraseña?
                        </a>
                    </div>

                    <!-- Login Button -->
                    <button type="submit"
                        class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-xl text-white bg-gradient-to-r from-[#0077cc] to-blue-600 hover:from-blue-700 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#0077cc] transition duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                        <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                            <svg class="h-5 w-5 text-blue-200 group-hover:text-blue-100 transition duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                            </svg>
                        </span>
                        Iniciar Sesión
                    </button>
                </form>

                <!-- Footer -->
                <div class="mt-8 text-center">
                    <p class="text-xs text-gray-500">
                        © 2024 Farmacia 701. Sistema seguro de administración.
                    </p>
                </div>
            </div>
        </div>

        <!-- Enhanced decorative elements -->
        <div class="absolute -top-6 -right-6 w-32 h-32 bg-gradient-to-br from-[#0077cc]/20 to-blue-400/10 rounded-full blur-2xl animate-pulse"></div>
        <div class="absolute -bottom-6 -left-6 w-40 h-40 bg-gradient-to-br from-[#0077cc]/10 to-blue-300/5 rounded-full blur-2xl animate-pulse" style="animation-delay: 1.5s;"></div>
    </div>

    <style>
        @keyframes float {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            50% {
                transform: translateY(-12px) rotate(6deg);
            }
        }

        /* Enhanced scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: rgba(119, 169, 255, 0.1);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(180deg, #0077cc, #005fa3);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(180deg, #005fa3, #004080);
        }

        /* Custom animations */
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
    </style>
</body>

</html>