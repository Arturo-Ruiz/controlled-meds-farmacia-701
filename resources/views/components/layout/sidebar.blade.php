<!-- Sidebar Component -->
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
                <div class="w-16 h-16 flex items-center justify-center transition-all duration-300">
                    <img src="{{ asset('img/logo.png') }}" alt="Farmacia 701" class="w-12 h-12 object-contain">
                </div>
                <div>
                    <h1 class="text-xl font-bold text-gray-800 transition-colors duration-300">Farmacia 701</h1>
                </div>

                <button id="sidebarClose" class="lg:hidden absolute top-4 right-4 p-2 text-gray-500 hover:text-gray-700 transition-colors duration-200">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
        </div>

        <!-- Navigation Menu -->
        <nav class="relative z-10 p-4 space-y-2">

            <!-- Dashboard -->
            <a href="{{ route('dashboard') }}"
                class="nav-item group flex items-center px-4 py-3 rounded-xl transition-all duration-300 hover:translate-x-1    
   {{ request()->routeIs('dashboard') ? 'bg-blue-100 text-blue-700 border-r-4 border-blue-500' : 'text-gray-600 hover:text-gray-800 hover:bg-blue-50' }}">

                <div class="w-10 h-10 rounded-lg flex items-center justify-center mr-3 transition-all duration-300  
         {{ request()->routeIs('dashboard') ? 'bg-blue-200' : 'bg-gray-100 group-hover:bg-blue-100' }}">
                    <i class="fas fa-tachometer-alt text-lg transition-all duration-300  
           {{ request()->routeIs('dashboard') ? 'text-blue-700' : 'text-gray-600 group-hover:text-blue-600' }}"></i>
                </div>

                <span class="font-medium">Panel de control</span>

                <div class="ml-auto w-2 h-2 rounded-full transition-opacity duration-300  
         {{ request()->routeIs('dashboard') ? 'bg-blue-500 opacity-100' : 'bg-blue-400 opacity-0 group-hover:opacity-100' }}"></div>
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