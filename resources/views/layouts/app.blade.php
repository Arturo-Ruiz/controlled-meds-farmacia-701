<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') - Farmacia 701</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="bg-gradient-to-br from-gray-50 via-blue-50/30 to-indigo-50/20 font-inter overflow-x-hidden">
    <!-- Sidebar -->
    <div class="fixed inset-y-0 left-0 z-50 w-72 transform -translate-x-full lg:translate-x-0 transition-all duration-300 ease-in-out" id="sidebar">
        <!-- Sidebar Background with Light Gradient -->
        <div class="h-full bg-gradient-to-b from-white via-gray-50 to-gray-100 shadow-2xl relative overflow-hidden border-r border-gray-200">
            <!-- Animated Background Elements -->
            <div class="absolute inset-0 overflow-hidden">
                <div class="absolute -top-20 -right-20 w-40 h-40 bg-blue-500/5 rounded-full blur-3xl animate-pulse"></div>
                <div class="absolute -bottom-20 -left-20 w-32 h-32 bg-purple-500/5 rounded-full blur-2xl animate-pulse" style="animation-delay: 2s;"></div>
                <div class="absolute top-1/2 right-0 w-1 h-32 bg-gradient-to-b from-transparent via-blue-400/10 to-transparent animate-pulse" style="animation-delay: 1s;"></div>
            </div>

            <!-- Logo Section -->
            <div class="relative z-10 p-6 border-b border-gray-200/50">
                <div class="flex items-center space-x-3 group">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-cyan-400 rounded-xl flex items-center justify-center shadow-lg group-hover:shadow-blue-500/25 transition-all duration-300 group-hover:scale-105">
                        <i class="fas fa-clinic-medical text-white text-xl"></i>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-gray-800 group-hover:text-blue-600 transition-colors duration-300">Farmacia 701</h1>
                        <p class="text-gray-500 text-sm">Sistema de Control</p>
                    </div>
                </div>
            </div>

            <!-- Navigation Menu -->
            <nav class="relative z-10 p-4 space-y-2">
                <!-- Dashboard -->
                <a href="{{ route('dashboard') }}" class="nav-item group flex items-center px-4 py-3 text-gray-600 hover:text-gray-800 hover:bg-blue-50 rounded-xl transition-all duration-300 hover:translate-x-1">
                    <div class="w-10 h-10 bg-gray-100 group-hover:bg-blue-100 rounded-lg flex items-center justify-center mr-3 transition-all duration-300">
                        <i class="fas fa-tachometer-alt text-lg text-gray-600 group-hover:text-blue-600"></i>
                    </div>
                    <span class="font-medium">Dashboard</span>
                    <div class="ml-auto w-2 h-2 bg-blue-400 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </a>

                <!-- Medicamentos -->
                <a href="#" class="nav-item group flex items-center px-4 py-3 text-gray-600 hover:text-gray-800 hover:bg-green-50 rounded-xl transition-all duration-300 hover:translate-x-1">
                    <div class="w-10 h-10 bg-gray-100 group-hover:bg-green-100 rounded-lg flex items-center justify-center mr-3 transition-all duration-300">
                        <i class="fas fa-pills text-lg text-gray-600 group-hover:text-green-600"></i>
                    </div>
                    <span class="font-medium">Medicamentos</span>
                    <div class="ml-auto w-2 h-2 bg-green-400 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </a>

                <!-- Inventario -->
                <a href="#" class="nav-item group flex items-center px-4 py-3 text-gray-600 hover:text-gray-800 hover:bg-purple-50 rounded-xl transition-all duration-300 hover:translate-x-1">
                    <div class="w-10 h-10 bg-gray-100 group-hover:bg-purple-100 rounded-lg flex items-center justify-center mr-3 transition-all duration-300">
                        <i class="fas fa-boxes text-lg text-gray-600 group-hover:text-purple-600"></i>
                    </div>
                    <span class="font-medium">Inventario</span>
                    <div class="ml-auto w-2 h-2 bg-purple-400 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </a>

                <!-- Entradas -->
                <a href="#" class="nav-item group flex items-center px-4 py-3 text-gray-600 hover:text-gray-800 hover:bg-emerald-50 rounded-xl transition-all duration-300 hover:translate-x-1">
                    <div class="w-10 h-10 bg-gray-100 group-hover:bg-emerald-100 rounded-lg flex items-center justify-center mr-3 transition-all duration-300">
                        <i class="fas fa-arrow-down text-lg text-gray-600 group-hover:text-emerald-600"></i>
                    </div>
                    <span class="font-medium">Entradas</span>
                    <div class="ml-auto w-2 h-2 bg-emerald-400 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </a>

                <!-- Salidas -->
                <a href="#" class="nav-item group flex items-center px-4 py-3 text-gray-600 hover:text-gray-800 hover:bg-orange-50 rounded-xl transition-all duration-300 hover:translate-x-1">
                    <div class="w-10 h-10 bg-gray-100 group-hover:bg-orange-100 rounded-lg flex items-center justify-center mr-3 transition-all duration-300">
                        <i class="fas fa-arrow-up text-lg text-gray-600 group-hover:text-orange-600"></i>
                    </div>
                    <span class="font-medium">Salidas</span>
                    <div class="ml-auto w-2 h-2 bg-orange-400 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </a>

                <!-- Reportes -->
                <a href="#" class="nav-item group flex items-center px-4 py-3 text-gray-600 hover:text-gray-800 hover:bg-indigo-50 rounded-xl transition-all duration-300 hover:translate-x-1">
                    <div class="w-10 h-10 bg-gray-100 group-hover:bg-indigo-100 rounded-lg flex items-center justify-center mr-3 transition-all duration-300">
                        <i class="fas fa-chart-bar text-lg text-gray-600 group-hover:text-indigo-600"></i>
                    </div>
                    <span class="font-medium">Reportes</span>
                    <div class="ml-auto w-2 h-2 bg-indigo-400 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </a>

                <!-- Configuración -->
                <a href="#" class="nav-item group flex items-center px-4 py-3 text-gray-600 hover:text-gray-800 hover:bg-gray-50 rounded-xl transition-all duration-300 hover:translate-x-1">
                    <div class="w-10 h-10 bg-gray-100 group-hover:bg-gray-200 rounded-lg flex items-center justify-center mr-3 transition-all duration-300">
                        <i class="fas fa-cog text-lg text-gray-600 group-hover:text-gray-700"></i>
                    </div>
                    <span class="font-medium">Configuración</span>
                    <div class="ml-auto w-2 h-2 bg-gray-400 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </a>
            </nav>

            <!-- User Profile Section -->
            <div class="absolute bottom-0 left-0 right-0 p-4 border-t border-gray-200/50">
                <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-xl">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-500 rounded-full flex items-center justify-center">
                        <i class="fas fa-user text-white text-sm"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-gray-800 text-sm font-medium truncate">{{ Auth::user()->name ?? 'Administrador' }}</p>
                        <p class="text-gray-500 text-xs truncate">{{ Auth::user()->email ?? 'admin@farmacia701.com' }}</p>
                    </div>
                    <form method="POST" action="{{ route('logout') }}" class="opacity-70 hover:opacity-100 transition-opacity duration-300">
                        @csrf
                        <button type="submit" class="p-2 text-gray-500 hover:text-red-500 transition-colors duration-300">
                            <i class="fas fa-sign-out-alt"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="lg:ml-72 min-h-screen">
        <!-- Top Header -->
        <header class="bg-white/80 backdrop-blur-sm border-b border-gray-200/50 sticky top-0 z-40">
            <div class="px-6 py-4">
                <div class="flex items-center justify-between">
                    <!-- Mobile Menu Button -->
                    <button id="sidebarToggle" class="lg:hidden p-2 rounded-lg text-gray-600 hover:bg-gray-100 transition-colors duration-200">
                        <i class="fas fa-bars text-xl"></i>
                    </button>

                    <!-- Page Title -->
                    <div class="flex-1 lg:flex-none">
                        <h2 class="text-2xl font-bold text-gray-900">@yield('title', 'Dashboard')</h2>
                        <p class="text-sm text-gray-600 mt-1">{{ now()->format('l, d F Y') }}</p>
                    </div>

                    <!-- User Menu -->
                    <div class="relative">
                        <button id="userMenuButton" class="flex items-center space-x-2 p-2 rounded-lg hover:bg-gray-100 transition-colors duration-200">
                            <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-purple-500 rounded-full flex items-center justify-center">
                                <i class="fas fa-user text-white text-sm"></i>
                            </div>
                            <span class="hidden md:block text-sm font-medium text-gray-700">{{ Auth::user()->name ?? 'Admin' }}</span>
                            <i class="fas fa-chevron-down text-gray-400 text-xs transition-transform duration-200" id="userMenuChevron"></i>
                        </button>

                        <!-- Dropdown Menu -->
                        <div id="userDropdown" class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 py-2 hidden z-50">
                            <div class="px-4 py-2 border-b border-gray-100">
                                <p class="text-sm font-medium text-gray-900">{{ Auth::user()->name ?? 'Admin' }}</p>
                                <p class="text-xs text-gray-500">{{ Auth::user()->email ?? 'admin@farmacia701.com' }}</p>
                            </div>
                            <form method="POST" action="{{ route('logout') }}" class="block">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors duration-200 flex items-center">
                                    <i class="fas fa-sign-out-alt mr-2"></i>
                                    Cerrar Sesión
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main Content Area -->
        <main class="p-6">
            @yield('content')
        </main>
    </div>

    <!-- Overlay for mobile -->
    <div id="sidebarOverlay" class="fixed inset-0 z-40 lg:hidden hidden"></div>

    <script>
        $(document).ready(function() {
            // Mobile sidebar toggle - VERSIÓN FINAL  
            $('#sidebarToggle').click(function(e) {
                e.preventDefault();
                e.stopPropagation();

                const $sidebar = $('#sidebar');
                const $overlay = $('#sidebarOverlay');

                // Toggle sidebar visibility  
                $sidebar.toggleClass('-translate-x-full');

                // Manejar overlay correctamente  
                if ($sidebar.hasClass('-translate-x-full')) {
                    // Sidebar cerrado - ocultar overlay  
                    $overlay.addClass('hidden').hide();
                    $('body').removeClass('overflow-hidden');
                } else {
                    // Sidebar abierto - mostrar overlay solo en móvil  
                    if ($(window).width() < 1024) {
                        $overlay.removeClass('hidden').show();
                        $('body').addClass('overflow-hidden');
                    }
                }
            });

            // Close sidebar when clicking overlay  
            $('#sidebarOverlay').click(function() {
                $('#sidebar').addClass('-translate-x-full');
                $('#sidebarOverlay').addClass('hidden').hide();
                $('body').removeClass('overflow-hidden');
            });

            // Close sidebar on window resize to desktop  
            $(window).resize(function() {
                if ($(window).width() >= 1024) {
                    $('#sidebar').removeClass('-translate-x-full');
                    $('#sidebarOverlay').addClass('hidden').hide();
                    $('body').removeClass('overflow-hidden');
                }
            });

            // Asegurar estado inicial correcto  
            $(window).on('load', function() {
                if ($(window).width() < 1024) {
                    $('#sidebar').addClass('-translate-x-full');
                }
                $('#sidebarOverlay').addClass('hidden').hide();
            });

            // Add active state to current page  
            const currentPath = window.location.pathname;
            $('.nav-item').each(function() {
                if ($(this).attr('href') === currentPath) {
                    $(this).addClass('bg-blue-600/20 text-blue-400 border-r-2 border-blue-400');
                    $(this).find('i').addClass('text-blue-400');
                }
            });

            // Smooth hover effects for nav items  
            $('.nav-item').hover(
                function() {
                    if (!$(this).hasClass('bg-blue-600/20')) {
                        $(this).addClass('bg-slate-700/50 text-slate-200 transform translate-x-1');
                    }
                },
                function() {
                    if (!$(this).hasClass('bg-blue-600/20')) {
                        $(this).removeClass('bg-slate-700/50 text-slate-200 transform translate-x-1');
                    }
                }
            );

            // Animated counter for stats cards  
            $('.stat-number').each(function() {
                const $this = $(this);
                const countTo = parseInt($this.text());

                $({
                    countNum: 0
                }).animate({
                    countNum: countTo
                }, {
                    duration: 2000,
                    easing: 'swing',
                    step: function() {
                        $this.text(Math.floor(this.countNum));
                    },
                    complete: function() {
                        $this.text(this.countNum);
                    }
                });
            });

            // Notification dropdown toggle  
            $('.notification-btn').click(function(e) {
                e.stopPropagation();
                $('.notification-dropdown').toggleClass('hidden');
            });

            // Close notification dropdown when clicking outside  
            $(document).click(function() {
                $('.notification-dropdown').addClass('hidden');
            });

            // Search functionality  
            $('#searchInput').on('input', function() {
                const searchTerm = $(this).val().toLowerCase();
                $('.searchable-item').each(function() {
                    const text = $(this).text().toLowerCase();
                    if (text.includes(searchTerm)) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });

            // Tooltip functionality  
            $('[data-tooltip]').hover(
                function() {
                    const tooltip = $('<div class="tooltip absolute bg-gray-800 text-white text-xs px-2 py-1 rounded shadow-lg z-50">')
                        .text($(this).data('tooltip'));
                    $('body').append(tooltip);

                    const rect = this.getBoundingClientRect();
                    tooltip.css({
                        top: rect.top - tooltip.outerHeight() - 5,
                        left: rect.left + (rect.width / 2) - (tooltip.outerWidth() / 2)
                    });
                },
                function() {
                    $('.tooltip').remove();
                }
            );

            // Smooth scroll animations  
            $('.animate-on-scroll').each(function() {
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            $(entry.target).addClass('animate-fadeInUp');
                        }
                    });
                });
                observer.observe(this);
            });

            // Card hover effects  
            $('.hover-card').hover(
                function() {
                    $(this).addClass('transform scale-105 shadow-xl');
                },
                function() {
                    $(this).removeClass('transform scale-105 shadow-xl');
                }
            );

            // Button loading states  
            $('.btn-loading').click(function() {
                const $btn = $(this);
                const originalText = $btn.text();

                $btn.prop('disabled', true)
                    .html('<i class="fas fa-spinner fa-spin mr-2"></i>Cargando...');

                setTimeout(() => {
                    $btn.prop('disabled', false).text(originalText);
                }, 2000);
            });

            // Modal functionality  
            $('.modal-trigger').click(function() {
                const modalId = $(this).data('modal');
                $(`#${modalId}`).removeClass('hidden').addClass('flex');
            });

            $('.modal-close').click(function() {
                $(this).closest('.modal').addClass('hidden').removeClass('flex');
            });

            // Tab functionality  
            $('.tab-button').click(function() {
                const tabId = $(this).data('tab');

                // Remove active class from all tabs and buttons  
                $('.tab-button').removeClass('bg-blue-600 text-white').addClass('text-gray-600');
                $('.tab-content').addClass('hidden');

                // Add active class to clicked button and show content  
                $(this).removeClass('text-gray-600').addClass('bg-blue-600 text-white');
                $(`#${tabId}`).removeClass('hidden');
            });

            // Form validation  
            $('.validate-form').submit(function(e) {
                let isValid = true;

                $(this).find('input[required]').each(function() {
                    if (!$(this).val()) {
                        $(this).addClass('border-red-500');
                        isValid = false;
                    } else {
                        $(this).removeClass('border-red-500');
                    }
                });

                if (!isValid) {
                    e.preventDefault();
                    $('.error-message').removeClass('hidden');
                }
            });

            // Auto-hide alerts  
            $('.alert-auto-hide').each(function() {
                const $alert = $(this);
                setTimeout(() => {
                    $alert.fadeOut();
                }, 5000);
            });

            // Responsive sidebar collapse  
            $(window).resize(function() {
                if ($(window).width() >= 1024) {
                    $('#sidebar').removeClass('-translate-x-full');
                    $('#sidebarOverlay').addClass('hidden');
                }
            });

            $('#userMenuButton').click(function(e) {
                e.stopPropagation();
                $('#userDropdown').toggleClass('hidden');
                $('#userMenuChevron').toggleClass('rotate-180');
            });

            // Close dropdown when clicking outside  
            $(document).click(function() {
                $('#userDropdown').addClass('hidden');
                $('#userMenuChevron').removeClass('rotate-180');
            });

            // Prevent dropdown from closing when clicking inside it  
            $('#userDropdown').click(function(e) {
                e.stopPropagation();
            });
        });
    </script>
    <style>
        /* Custom animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes pulse-glow {

            0%,
            100% {
                box-shadow: 0 0 5px rgba(59, 130, 246, 0.5);
            }

            50% {
                box-shadow: 0 0 20px rgba(59, 130, 246, 0.8);
            }
        }

        .animate-fadeInUp {
            animation: fadeInUp 0.6s ease-out;
        }

        .animate-slideInLeft {
            animation: slideInLeft 0.5s ease-out;
        }

        .pulse-glow {
            animation: pulse-glow 2s infinite;
        }

        /* Hover transitions */
        .transition-all {
            transition: all 0.3s ease;
        }

        /* Loading animation */
        .loading-spinner {
            border: 2px solid #f3f4f6;
            border-top: 2px solid #3b82f6;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* Glass morphism effects */
        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        /* SIDEBAR RESPONSIVE - CORREGIDO */
        @media (max-width: 1023px) {

            /* Asegurar que el sidebar mantenga su ancho completo en móvil */
            #sidebar {
                width: 18rem;
                /* 288px - mantener ancho completo */
            }

            /* Cuando está oculto, moverlo completamente fuera de pantalla */
            #sidebar.-translate-x-full {
                transform: translateX(-100%);
            }

            /* Cuando está visible, mostrarlo completamente */
            #sidebar:not(.-translate-x-full) {
                transform: translateX(0);
            }

            /* Prevenir scroll del body cuando sidebar está abierto */
            body.overflow-hidden {
                overflow: hidden;
            }
        }

        /* En desktop, asegurar que esté siempre visible */
        @media (min-width: 1024px) {
            #sidebar {
                transform: translateX(0) !important;
            }
        }

        #sidebarOverlay {
            display: none !important;
        }

        #sidebarOverlay:not(.hidden) {
            display: block !important;
        }

        /* En desktop, el overlay NUNCA debe ser visible */
        @media (min-width: 1024px) {
            #sidebarOverlay {
                display: none !important;
                visibility: hidden !important;
                opacity: 0 !important;
            }
        }

        /* En móvil, solo visible cuando no tiene clase hidden */
        @media (max-width: 1023px) {
            #sidebarOverlay.hidden {
                display: none !important;
                visibility: hidden !important;
                opacity: 0 !important;
            }
        }
    </style>
</body>

</html>