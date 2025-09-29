<div class="relative w-full max-w-md animate-fadeInUp">
    <div class="bg-white rounded-2xl shadow-xl p-8">
        <!-- Header -->
        <div class="text-center mb-8 animate-fadeInUp">
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
        <form method="POST" action="{{ route('login') }}" id="loginForm" class="animate-fadeInUp">
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
                    <span class="ml-2 text-sm text-gray-600">Recuérdame</span>
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
        <div class="mt-8 text-center animate-fadeInUp">
            <p class="text-sm text-gray-500 flex items-center justify-center space-x-1">
                <span>© 2025 made with</span>
                <i class="fa fa-heart text-red-500"></i>
                <span>by</span>
                <a href="https://github.com/Arturo-Ruiz" class="text-blue-600 hover:text-blue-800 font-medium transition-colors duration-200" target="_blank">Arturo Ruiz</a>
                <span>for Farmacia 701.</span>
            </p>
        </div>
    </div>
</div>
</div>