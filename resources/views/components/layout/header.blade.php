<!-- Header Component -->
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