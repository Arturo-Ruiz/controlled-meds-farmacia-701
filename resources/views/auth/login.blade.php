<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - Farmacia 701</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>

<body class="min-h-screen bg-gradient-to-br from-blue-100 to-blue-200 flex items-center justify-center p-4 relative overflow-hidden" style="font-family: 'Inter', sans-serif;">

    <!-- Enhanced Animated Background -->
    <div class="absolute inset-0 overflow-hidden">
        <!-- Gradiente base mejorado -->
        <div class="absolute inset-0 bg-gradient-to-br from-blue-50 via-indigo-100 to-purple-100"></div>

        <!-- Capas de gradientes animados -->
        <div class="absolute inset-0 bg-gradient-to-tr from-cyan-200/30 via-blue-300/20 to-indigo-400/30 animate-pulse" style="animation-duration: 8s;"></div>
        <div class="absolute inset-0 bg-gradient-to-bl from-purple-200/20 via-pink-200/10 to-blue-300/25 animate-pulse" style="animation-duration: 12s; animation-delay: 2s;"></div>

        <!-- Formas geométricas grandes mejoradas -->
        <div class="absolute -top-32 -right-32 w-96 h-96 bg-gradient-to-br from-blue-400/20 to-cyan-500/15 rounded-full blur-3xl animate-pulse" style="animation-duration: 6s;"></div>
        <div class="absolute -bottom-32 -left-32 w-[500px] h-[500px] bg-gradient-to-tr from-indigo-400/15 to-purple-500/20 rounded-full blur-3xl animate-pulse" style="animation-duration: 8s; animation-delay: 3s;"></div>
        <div class="absolute top-1/3 right-1/4 w-64 h-64 bg-gradient-to-br from-cyan-300/25 to-blue-400/20 rounded-full blur-2xl animate-bounce" style="animation-duration: 10s;"></div>

        <!-- Formas medianas flotantes -->
        <div class="absolute top-20 left-1/4 w-40 h-40 bg-gradient-to-br from-pink-300/20 to-purple-400/15 rounded-full blur-xl animate-pulse" style="animation-duration: 7s; animation-delay: 1s;"></div>
        <div class="absolute bottom-1/4 right-1/3 w-48 h-48 bg-gradient-to-br from-emerald-300/15 to-teal-400/20 rounded-full blur-xl animate-pulse" style="animation-duration: 9s; animation-delay: 4s;"></div>

        <!-- CÍRCULOS PEQUEÑOS ADICIONALES -->
        <div class="absolute top-1/5 right-2/5 w-20 h-20 bg-gradient-to-br from-emerald-300/15 to-green-400/20 rounded-full blur-lg animate-pulse" style="animation-duration: 11s; animation-delay: 6s;"></div>
        <div class="absolute bottom-1/5 left-2/5 w-24 h-24 bg-gradient-to-br from-orange-300/10 to-yellow-400/15 rounded-full blur-lg animate-pulse" style="animation-duration: 13s; animation-delay: 8s;"></div>

        <!-- FORMAS HEXAGONALES -->
        <div class="absolute top-2/5 right-1/5 w-16 h-16 bg-gradient-to-br from-violet-300/20 to-purple-400/15 transform rotate-45 blur-md animate-pulse" style="animation-duration: 9s; animation-delay: 10s;"></div>

        <!-- ICONOS MÉDICOS FLOTANTES ORIGINALES -->
        <!-- Medicamentos/Píldoras -->
        <div class="absolute top-1/4 left-1/6 text-blue-300/30 animate-medical-float" style="animation-delay: 1s;">
            <i class="fas fa-pills text-4xl"></i>
        </div>
        <div class="absolute bottom-1/3 right-1/5 text-indigo-300/25 animate-medical-drift" style="animation-delay: 3s;">
            <i class="fas fa-capsules text-3xl"></i>
        </div>
        <div class="absolute top-2/3 left-1/3 text-purple-300/20 animate-medical-float" style="animation-delay: 5s;">
            <i class="fas fa-tablets text-2xl"></i>
        </div>

        <!-- Recetas y documentos médicos -->
        <div class="absolute top-1/6 right-1/3 text-cyan-300/25 animate-medical-drift" style="animation-delay: 2s;">
            <i class="fas fa-prescription text-3xl"></i>
        </div>
        <div class="absolute bottom-1/4 left-1/4 text-blue-300/30 animate-medical-float" style="animation-delay: 4s;">
            <i class="fas fa-file-medical text-2xl"></i>
        </div>
        <div class="absolute top-1/2 right-1/6 text-indigo-300/20 animate-medical-drift" style="animation-delay: 6s;">
            <i class="fas fa-prescription-bottle text-3xl"></i>
        </div>

        <!-- Equipos médicos -->
        <div class="absolute bottom-1/6 right-1/4 text-purple-300/25 animate-medical-float" style="animation-delay: 7s;">
            <i class="fas fa-stethoscope text-2xl"></i>
        </div>
        <div class="absolute top-1/3 left-1/5 text-cyan-300/20 animate-medical-drift" style="animation-delay: 8s;">
            <i class="fas fa-syringe text-2xl"></i>
        </div>
        <div class="absolute bottom-2/3 right-1/2 text-blue-300/25 animate-medical-float" style="animation-delay: 9s;">
            <i class="fas fa-thermometer text-2xl"></i>
        </div>

        <!-- Símbolos médicos adicionales -->
        <div class="absolute top-1/5 left-1/2 text-indigo-300/30 animate-medical-drift" style="animation-delay: 10s;">
            <i class="fas fa-heartbeat text-3xl"></i>
        </div>
        <div class="absolute bottom-1/5 left-1/6 text-purple-300/20 animate-medical-float" style="animation-delay: 11s;">
            <i class="fas fa-user-md text-2xl"></i>
        </div>
        <div class="absolute top-3/4 right-1/3 text-cyan-300/25 animate-medical-drift" style="animation-delay: 12s;">
            <i class="fas fa-hospital text-2xl"></i>
        </div>

        <!-- MÁS ICONOS MÉDICOS ADICIONALES -->
        <!-- Más medicamentos -->
        <div class="absolute top-1/8 right-1/8 text-emerald-300/25 animate-medical-float" style="animation-delay: 13s;">
            <i class="fas fa-mortar-pestle text-3xl"></i>
        </div>
        <div class="absolute bottom-1/8 left-1/8 text-teal-300/20 animate-medical-drift" style="animation-delay: 14s;">
            <i class="fas fa-prescription-bottle-medical text-2xl"></i>
        </div>

        <!-- Equipos adicionales -->
        <div class="absolute top-3/5 left-1/8 text-blue-300/30 animate-medical-float" style="animation-delay: 15s;">
            <i class="fas fa-microscope text-2xl"></i>
        </div>
        <div class="absolute bottom-2/5 right-1/8 text-purple-300/25 animate-medical-drift" style="animation-delay: 16s;">
            <i class="fas fa-dna text-3xl"></i>
        </div>

        <!-- Símbolos de salud -->
        <div class="absolute top-1/7 left-2/5 text-cyan-300/20 animate-medical-float" style="animation-delay: 17s;">
            <i class="fas fa-plus-circle text-2xl"></i>
        </div>
        <div class="absolute bottom-1/7 right-2/5 text-indigo-300/25 animate-medical-drift" style="animation-delay: 18s;">
            <i class="fas fa-shield-virus text-2xl"></i>
        </div>

        <!-- PARTÍCULAS ADICIONALES -->
        <div class="absolute top-1/8 left-3/5 w-2 h-2 bg-emerald-400/50 rounded-full animate-ping" style="animation-delay: 6s; animation-duration: 4s;"></div>
        <div class="absolute bottom-1/8 right-3/5 w-3 h-3  bg-violet-400/60 rounded-full animate-ping" style="animation-delay: 7s; animation-duration: 3s;"></div>
        <div class="absolute top-3/8 left-4/5 w-1 h-1 bg-violet-400/60 rounded-full animate-ping" style="animation-delay: 8s; animation-duration: 2.5s;"></div>
        <div class="absolute bottom-3/8 right-4/5 w-2 h-2 bg-teal-400/45 rounded-full animate-ping" style="animation-delay: 9s; animation-duration: 3.5s;"></div>

        <!-- Partículas flotantes originales -->
        <div class="absolute top-1/4 right-1/3 w-4 h-4 bg-blue-400/40 rounded-full animate-ping" style="animation-delay: 1s; animation-duration: 3s;"></div>
        <div class="absolute bottom-1/3 left-1/5 w-3 h-3 bg-purple-400/50 rounded-full animate-ping" style="animation-delay: 2s; animation-duration: 4s;"></div>
        <div class="absolute top-2/3 right-1/4 w-2 h-2 bg-cyan-400/60 rounded-full animate-ping" style="animation-delay: 3s; animation-duration: 2s;"></div>
        <div class="absolute top-1/2 left-1/3 w-3 h-3 bg-indigo-400/45 rounded-full animate-ping" style="animation-delay: 4s; animation-duration: 3.5s;"></div>
        <div class="absolute bottom-1/4 right-1/2 w-2 h-2 bg-pink-400/55 rounded-full animate-ping" style="animation-delay: 5s; animation-duration: 2.5s;"></div>

        <!-- EFECTOS DE LUZ ADICIONALES -->
        <!-- Rayos de luz suaves -->
        <div class="absolute top-0 left-1/3 w-1 h-full bg-gradient-to-b from-transparent via-blue-200/10 to-transparent transform -skew-x-12 animate-pulse" style="animation-duration: 15s;"></div>
        <div class="absolute top-0 right-1/3 w-1 h-full bg-gradient-to-b from-transparent via-purple-200/8 to-transparent transform skew-x-12 animate-pulse" style="animation-duration: 18s; animation-delay: 5s;"></div>

        <!-- Patrón de grid sutil -->
        <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width=\\" 60\\" height=\\"60\\" viewBox=\\"0 0 60 60\\" xmlns=\\"http://www.w3.org/2000/svg\\"%3E%3Cg fill=\\"none\\" fill-rule=\\"evenodd\\"%3E%3Cg fill=\\"%233b82f6\\" fill-opacity=\\"0.03\\"%3E%3Ccircle cx=\\"30\\" cy=\\"30\\" r=\\"1.5\\"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] opacity-40"></div>

        <!-- PATRÓN DE CRUCES MÉDICAS -->
        <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width=\\" 80\\" height=\\"80\\" viewBox=\\"0 0 80 80\\" xmlns=\\"http://www.w3.org/2000/svg\\"%3E%3Cg fill=\\"%233b82f6\\" fill-opacity=\\"0.02\\"%3E%3Cpath d=\\"M35 35h10v10h-10z\\"/%3E%3Cpath d=\\"M30 40h20v5h-20z\\"/%3E%3C/g%3E%3C/svg%3E')] opacity-30"></div>

        <!-- Ondas sutiles -->
        <div class="absolute bottom-0 left-0 right-0 h-32 bg-gradient-to-t from-blue-200/30 to-transparent"></div>
        <div class="absolute top-0 left-0 right-0 h-32 bg-gradient-to-b from-indigo-200/20 to-transparent"></div>
    </div>

    <!-- Container principal -->
    <div class="relative w-full max-w-md">
        <div class="bg-white rounded-2xl shadow-xl p-8">

            <!-- Header -->
            <div class="text-center mb-8">
                <div class="w-16 h-16 bg-blue-600 rounded-xl flex items-center justify-center mx-auto mb-4">
                    <i class="fa-solid fa-capsules text-white text-2xl"></i>
                </div>
                <h1 class="text-2xl font-bold text-gray-800">Iniciar Sesión</h1>
                <p class="text-gray-600">Sistema de administración de medicamentos controlados.</p>
            </div>

            <!-- Mensajes de error/éxito -->
            @if (session('status'))
            <div class="mb-6 p-4 bg-green-100 border border-green-300 rounded-lg">
                <div class="flex items-center">
                    <i class="fas fa-check-circle text-green-600 mr-2"></i>
                    <span class="text-green-700">{{ session('status') }}</span>
                </div>
            </div>
            @endif
            <form method="POST" action="{{ route('login') }}" id="loginForm">
                @csrf

                <!-- Campo Email -->
                <div class="mb-6">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                        Correo Electrónico
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center">
                            <i class="fas fa-envelope text-gray-400"></i>
                        </div>
                        <input type="email"
                            name="email"
                            id="email"
                            required
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('email') border-red-500 @enderror"
                            placeholder="admin@farmacia701.com"
                            value="{{ old('email') }}">
                    </div>
                    @error('email')
                    <p class="mt-1 text-sm text-red-600">
                        <i class="fas fa-exclamation-circle mr-1"></i>
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                <!-- Campo Contraseña -->
                <div class="mb-6">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                        Contraseña
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center">
                            <i class="fas fa-lock text-gray-400"></i>
                        </div>
                        <input type="password"
                            name="password"
                            id="password"
                            required
                            class="w-full pl-10 pr-12 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('password') border-red-500 @enderror"
                            placeholder="••••••••">
                        <button type="button"
                            id="togglePassword"
                            class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 focus:outline-none"
                            aria-label="Mostrar contraseña">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    @error('password')
                    <p class="mt-1 text-sm text-red-600">
                        <i class="fas fa-exclamation-circle mr-1"></i>
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                <!-- Recordarme y Olvidé contraseña -->
                <div class="flex items-center justify-between mb-6">
                    <label class="flex items-center">
                        <input type="checkbox" name="remember" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                        <span class="ml-2 text-sm text-gray-600">Recordarme</span>
                    </label>
                    @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:text-blue-800">
                        ¿Olvidaste tu contraseña?
                    </a>
                    @endif
                </div>

                <!-- Botón Login -->
                <button type="submit"
                    id="loginBtn"
                    class="w-full bg-blue-600 text-white py-3 px-4 rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors font-medium">
                    <span id="btnText">
                        <i class="fas fa-sign-in-alt mr-2"></i>
                        Iniciar Sesión
                    </span>
                    <span id="btnLoading" class="hidden">
                        <i class="fas fa-spinner fa-spin mr-2"></i>
                        Iniciando sesión...
                    </span>
                </button>
            </form>

            <!-- Footer -->
            <div class="mt-8 text-center">
                <div class="copyright">
                    © <script>
                        document.write(new Date().getFullYear())
                    </script>
                    made with <i class="fa fa-heart"></i> by
                    <a href="https://github.com/Arturo-Ruiz" class="font-weight-bold" target="_blank">Arturo Ruiz</a>
                    for Farmacia 701.
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Auto-focus en email  
            $('#email').focus();

            // Toggle mostrar/ocultar contraseña - SOLUCIÓN MEJORADA  
            $('#togglePassword').on('click', function(e) {
                e.preventDefault();

                const passwordField = $('#password');
                const currentType = passwordField.attr('type');

                if (currentType === 'password') {
                    // Mostrar contraseña  
                    passwordField.attr('type', 'text');
                    $(this).html('<i class="fas fa-eye-slash"></i>');
                    $(this).attr('aria-label', 'Ocultar contraseña');
                } else {
                    // Ocultar contraseña  
                    passwordField.attr('type', 'password');
                    $(this).html('<i class="fas fa-eye"></i>');
                    $(this).attr('aria-label', 'Mostrar contraseña');
                }
            });

            // Navegación con Enter  
            $('#email').on('keypress', function(e) {
                if (e.which === 13) {
                    e.preventDefault();
                    $('#password').focus();
                }
            });

            $('#password').on('keypress', function(e) {
                if (e.which === 13) {
                    e.preventDefault();
                    $('#loginForm').submit();
                }
            });

            // Estado de carga del formulario  
            $('#loginForm').on('submit', function() {
                const btn = $('#loginBtn');
                const btnText = $('#btnText');
                const btnLoading = $('#btnLoading');

                btn.prop('disabled', true);
                btnText.addClass('hidden');
                btnLoading.removeClass('hidden');

                // Timeout de seguridad para re-habilitar  
                setTimeout(function() {
                    btn.prop('disabled', false);
                    btnText.removeClass('hidden');
                    btnLoading.addClass('hidden');
                }, 10000);
            });
        });
    </script>

    <style>
        /* Animaciones mejoradas para el background */
        @keyframes float-slow {

            0%,
            100% {
                transform: translateY(0px) translateX(0px) rotate(0deg);
            }

            33% {
                transform: translateY(-15px) translateX(10px) rotate(2deg);
            }

            66% {
                transform: translateY(10px) translateX(-5px) rotate(-1deg);
            }
        }

        @keyframes drift {

            0%,
            100% {
                transform: translateX(0px) translateY(0px);
            }

            25% {
                transform: translateX(20px) translateY(-10px);
            }

            50% {
                transform: translateX(-15px) translateY(15px);
            }

            75% {
                transform: translateX(10px) translateY(-20px);
            }
        }

        /* Animaciones específicas para iconos médicos */
        @keyframes medical-float {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg) scale(1);
                opacity: 0.3;
            }

            25% {
                transform: translateY(-15px) rotate(5deg) scale(1.1);
                opacity: 0.4;
            }

            50% {
                transform: translateY(-10px) rotate(-3deg) scale(1.05);
                opacity: 0.35;
            }

            75% {
                transform: translateY(-20px) rotate(2deg) scale(1.08);
                opacity: 0.25;
            }
        }

        @keyframes medical-drift {

            0%,
            100% {
                transform: translateX(0px) translateY(0px) rotate(0deg);
                opacity: 0.25;
            }

            20% {
                transform: translateX(15px) translateY(-8px) rotate(10deg);
                opacity: 0.35;
            }

            40% {
                transform: translateX(-10px) translateY(12px) rotate(-5deg);
                opacity: 0.3;
            }

            60% {
                transform: translateX(20px) translateY(-15px) rotate(8deg);
                opacity: 0.4;
            }

            80% {
                transform: translateX(-5px) translateY(10px) rotate(-3deg);
                opacity: 0.28;
            }
        }

        /* Aplicar animaciones a elementos específicos */
        .animate-float-slow {
            animation: float-slow 15s ease-in-out infinite;
        }

        .animate-drift {
            animation: drift 20s ease-in-out infinite;
        }

        /* Aplicar animaciones médicas */
        .animate-medical-float {
            animation: medical-float 18s ease-in-out infinite;
        }

        .animate-medical-drift {
            animation: medical-drift 22s ease-in-out infinite;
        }

        /* Efecto de respiración para las formas */
        @keyframes breathe {

            0%,
            100% {
                transform: scale(1);
                opacity: 0.6;
            }

            50% {
                transform: scale(1.1);
                opacity: 0.8;
            }
        }

        .animate-breathe {
            animation: breathe 8s ease-in-out infinite;
        }

        /* Estilos adicionales */
        .transition-colors {
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        input:focus {
            outline: none;
        }

        @media (max-width: 640px) {
            .container {
                padding: 1rem;
            }
        }
    </style>
</body>

</html>