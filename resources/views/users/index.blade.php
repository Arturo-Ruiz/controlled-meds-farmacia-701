@extends('layouts.app')

@section('title', 'Usuarios')

@section('content')
<div class="animate-fadeInUp">
    <!-- Header -->
    <div class="bg-gradient-to-r from-indigo-500 via-indigo-600 to-blue-600 rounded-2xl p-4 sm:p-6 lg:p-8 text-white shadow-2xl relative overflow-hidden mb-8">
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute -top-10 -right-10 w-32 h-32 bg-white/10 rounded-full blur-2xl animate-pulse"></div>
            <div class="absolute -bottom-10 -left-10 w-40 h-40 bg-white/5 rounded-full blur-3xl animate-pulse" style="animation-delay: 2s;"></div>
            <div class="absolute top-1/2 right-1/4 w-20 h-20 bg-white/5 rounded-full blur-xl animate-pulse" style="animation-delay: 4s;"></div>
        </div>

        <div class="relative z-10 flex flex-col lg:flex-row lg:items-center lg:justify-between space-y-4 lg:space-y-0">
            <div class="flex-1">
                <h1 class="text-xl sm:text-2xl lg:text-3xl font-bold mb-2">Gestión de Usuarios</h1>
                <p class="text-indigo-100 text-sm sm:text-base lg:text-lg mb-4 lg:mb-0">Administra los usuarios del sistema</p>
                <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-4 lg:space-x-6 space-y-2 sm:space-y-0 mt-4">
                    <div class="flex items-center space-x-2">
                        <i class="fas fa-users text-indigo-200"></i>
                        <span class="text-indigo-100 text-xs sm:text-sm">{{ $users->total() ?? 0 }} usuarios registrados</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <i class="fas fa-clock text-indigo-200"></i>
                        <span class="text-indigo-100 text-xs sm:text-sm">Actualizado {{ now()->translatedFormat('d/m/Y H:i') }}</span>
                    </div>
                </div>
            </div>
            <div class="flex items-center justify-center lg:justify-end">
                <button id="createUserBtn" class="bg-white/20 hover:bg-white/30 text-white px-4 sm:px-6 py-2 sm:py-3 rounded-xl font-medium transition-all duration-300 hover:scale-105 backdrop-blur-sm border border-white/20 shadow-lg text-sm sm:text-base w-full sm:w-auto">
                    <i class="fas fa-plus mr-2"></i>
                    <span class="hidden sm:inline">Nuevo Usuario</span>
                    <span class="sm:hidden">Nuevo</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Tabla de Usuarios -->
    <div class="bg-white rounded-xl shadow-lg border border-gray-100">
        <div class="p-6 border-b border-gray-200">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between space-y-4 lg:space-y-0">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Lista de Usuarios</h3>
                </div>

                <!-- Filtros en desktop -->
                <div class="hidden lg:flex items-center space-x-4">
                    <div class="w-64">
                        <label class="block text-xs font-medium text-gray-700 mb-1">Buscar usuario</label>
                        <div class="relative">
                            <input type="text" id="searchInput" placeholder="Nombre o email..."
                                class="w-full pl-8 pr-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                            <div class="absolute inset-y-0 left-0 pl-2 flex items-center">
                                <i class="fas fa-search text-gray-400 text-xs"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filtros en móvil -->
            <div class="lg:hidden mt-4">
                <div class="w-full">
                    <label class="block text-xs font-medium text-gray-700 mb-1">Buscar usuario</label>
                    <div class="relative">
                        <input type="text" id="searchInputMobile" placeholder="Nombre o email..."
                            class="w-full pl-8 pr-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        <div class="absolute inset-y-0 left-0 pl-2 flex items-center">
                            <i class="fas fa-search text-gray-400 text-xs"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if($users->count() > 0)
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-user text-gray-400"></i>
                                <span>Usuario</span>
                            </div>
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-envelope text-gray-400"></i>
                                <span>Email</span>
                            </div>
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-user-tag text-gray-400"></i>
                                <span>Rol</span>
                            </div>
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-calendar text-gray-400"></i>
                                <span>Fecha de Registro</span>
                            </div>
                        </th>
                        <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <div class="flex items-center justify-center space-x-2">
                                <i class="fas fa-cogs text-gray-400"></i>
                                <span>Acciones</span>
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($users as $user)
                    <tr class="hover:bg-gray-50 transition-colors duration-200">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas fa-user text-white text-sm"></i>
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                                    <div class="text-sm text-gray-500">ID: {{ $user->id }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $user->email }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs font-medium rounded-full   
                                {{ $user->roles->first()?->name === 'Administrator' ? 'bg-purple-100 text-purple-800' : '' }}  
                                {{ $user->roles->first()?->name === 'Manager' ? 'bg-blue-100 text-blue-800' : '' }}  
                                {{ $user->roles->first()?->name === 'Seller' ? 'bg-green-100 text-green-800' : '' }}">
                                {{ \App\Helpers\RoleHelper::translateRole($user->roles->first()?->name ?? 'Sin rol') }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $user->created_at->format('d/m/Y') }}</div>
                            <div class="text-sm text-gray-500">{{ $user->created_at->format('H:i') }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <div class="flex items-center justify-center space-x-2">
                                <button class="edit-user p-2 text-indigo-600 hover:text-indigo-700 hover:bg-indigo-50 rounded-lg transition-all duration-200"
                                    data-id="{{ $user->id }}"
                                    title="Editar usuario">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="delete-user p-2 text-red-600 hover:text-red-700 hover:bg-red-50 rounded-lg transition-all duration-200"
                                    data-id="{{ $user->id }}"
                                    title="Eliminar usuario">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="text-center py-12">
            <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-users text-gray-400 text-3xl"></i>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mb-2">No hay usuarios registrados</h3>
            <p class="text-gray-500 mb-6">Comienza agregando tu primer usuario</p>
            <button id="createUserBtn" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-xl font-medium transition-colors duration-200">
                <i class="fas fa-plus mr-2"></i>
                Agregar Usuario
            </button>
        </div>
        @endif

        <!-- Paginación -->
        @if($users->hasPages())
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $users->links() }}
        </div>
        @endif
    </div>
</div>

<!-- Modal -->
<div id="userModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center transition-opacity duration-300 opacity-0">
    <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full mx-4 max-h-[90vh] overflow-y-auto animate-fadeInUp">
        <div class="flex items-center justify-between p-6 border-b border-gray-200">
            <h3 id="userModalTitle" class="text-xl font-semibold text-gray-900">Crear Usuario</h3>
            <button class="modal-close p-2 hover:bg-gray-100 rounded-lg transition-colors duration-200">
                <i class="fas fa-times text-gray-500"></i>
            </button>
        </div>

        <form id="userForm" class="px-6 py-4">
            @csrf
            <input type="hidden" id="userId" name="id">

            <!-- Nombre -->
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nombre completo</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center">
                        <i class="fas fa-user text-gray-400"></i>
                    </div>
                    <input type="text" id="name" name="name" required
                        class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                    <span class="text-red-500 text-xs hidden" id="nameError"></span>
                </div>
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center">
                        <i class="fas fa-envelope text-gray-400"></i>
                    </div>
                    <input type="email" id="email" name="email" required
                        class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                    <span class="text-red-500 text-xs hidden" id="emailError"></span>
                </div>
            </div>

            <div class="mb-4">
                <label for="role" class="block text-sm font-medium text-gray-700 mb-1">Rol</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center">
                        <i class="fas fa-user-tag text-gray-400"></i>
                    </div>
                    <select id="role" name="role" required
                        class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        <option disabled selected>Seleccionar rol</option>
                        @foreach($roles as $role)
                        <option value="{{ $role['name'] }}">{{ $role['display_name'] }}</option>
                        @endforeach
                    </select>
                    <span class="text-red-500 text-xs hidden" id="roleError"></span>
                </div>
            </div>

            <!-- Contraseña -->
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                    <span id="passwordLabel">Contraseña</span>
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center">
                        <i class="fas fa-lock text-gray-400"></i>
                    </div>
                    <input type="password" id="password" name="password"
                        class="w-full pl-10 pr-12 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                    <button type="button"
                        id="togglePassword"
                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 focus:outline-none"
                        aria-label="Mostrar contraseña">
                        <i class="fas fa-eye"></i>
                    </button>
                    <span class="text-red-500 text-xs hidden" id="passwordError"></span>
                </div>
                <p class="text-xs text-gray-500 mt-1" id="passwordHelp">Mínimo 8 caracteres</p>
            </div>

        </form>

        <div class="px-6 py-4 border-t border-gray-200 flex justify-end space-x-3">
            <button id="cancelBtn" class="px-4 py-2 text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg transition-colors duration-200">
                Cancelar
            </button>
            <button id="saveBtn" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg transition-colors duration-200">
                Guardar
            </button>
        </div>
    </div>
</div>

<!-- CSS para animaciones -->
<style>
    .animate-fadeInUp {
        animation: fadeInUp 0.6s ease-out;
    }

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

    /* Modal backdrop blur effect */
    #userModal:not(.hidden) {
        backdrop-filter: blur(4px);
        background-color: rgba(0, 0, 0, 0.3);
    }

    /* Animación de entrada del modal */
    #userModal .bg-white {
        transform: scale(0.95);
        opacity: 0;
        transition: opacity 0.3s ease-in-out;
    }

    #userModal:not(.hidden) .bg-white {
        transform: scale(1);
        opacity: 1;
    }

    #userModal {
        transition: opacity 0.3s ease-in-out, backdrop-filter 0.3s ease-in-out;
    }

    #userModal .bg-white {
        transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.3s ease-in-out;
    }
</style>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Mantener valores de filtros después de la recarga  
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.get('search')) {
            const searchValue = urlParams.get('search');
            $('#searchInput').val(searchValue);
            $('#searchInputMobile').val(searchValue);
        }

        // Sincronización bidireccional de inputs  
        $('#searchInput').on('input', function() {
            const value = $(this).val();
            $('#searchInputMobile').val(value);
            clearTimeout(window.searchTimeout);
            window.searchTimeout = setTimeout(function() {
                applyFilters();
            }, 500);
        });

        $('#searchInputMobile').on('input', function() {
            const value = $(this).val();
            $('#searchInput').val(value);
            clearTimeout(window.searchTimeout);
            window.searchTimeout = setTimeout(function() {
                applyFilters();
            }, 500);
        });

        $("#togglePassword").on("click", function(e) {
            e.preventDefault();

            const passwordField = $("#password");
            const currentType = passwordField.attr("type");

            if (currentType === "password") {
                // Mostrar contraseña  
                passwordField.attr("type", "text");
                $(this).html('<i class="fas fa-eye-slash"></i>');
                $(this).attr("aria-label", "Ocultar contraseña");
            } else {
                // Ocultar contraseña  
                passwordField.attr("type", "password");
                $(this).html('<i class="fas fa-eye"></i>');
                $(this).attr("aria-label", "Mostrar contraseña");
            }
        });


        // Abrir modal para crear  
        $(document).on('click', '#createUserBtn', function() {
            $('#userModalTitle').text('Nuevo Usuario');
            $('#userForm')[0].reset();
            $('#userForm').attr('data-action', 'create');
            $('#userId').val('');
            $('#passwordLabel').text('Contraseña');
            $('#passwordHelp').text('Mínimo 8 caracteres');
            $('#password').prop('required', true);
            clearErrors();

            $('#userModal').removeClass('hidden opacity-0').addClass('flex opacity-100');
            setTimeout(() => {
                $('#userModal .bg-white').removeClass('scale-95').addClass('scale-100');
            }, 10);
        });

        // Cerrar modal  
        $('#cancelBtn, .modal-close').click(function() {
            closeModal();
        });

        function closeModal() {
            $('#userModal .bg-white').css({
                'transform': 'scale(0.95)',
                'opacity': '0.8'
            });

            setTimeout(() => {
                $('#userModal').css('opacity', '0');
                $('#userModal .bg-white').css({
                    'transform': 'scale(0.9)',
                    'opacity': '0'
                });
            }, 100);

            setTimeout(() => {
                $('#userModal').removeClass('flex opacity-100').addClass('hidden opacity-0');
                $('#userModal .bg-white').css({
                    'transform': '',
                    'opacity': ''
                }).removeClass('scale-95').addClass('scale-100');
                $('#userModal').css('opacity', '');
            }, 200);

            clearErrors();
        }

        // Manejar Enter para enviar el formulario  
        $('#userForm').on('keypress', function(e) {
            if (e.which === 13) {
                e.preventDefault();
                $('#saveBtn').click();
            }
        });

        $('#userModal').on('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });

        // Guardar usuario  
        $('#saveBtn').click(function() {
            const form = $('#userForm');
            const action = form.attr('data-action');
            const userId = $('#userId').val();

            let url = action === 'create' ? '{{ route("users.store") }}' :
                '{{ route("users.update", ":id") }}'.replace(':id', userId);
            let method = action === 'create' ? 'POST' : 'PUT';

            $.ajax({
                url: url,
                method: method,
                data: form.serialize(),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.success) {
                        closeModal();

                        if (action === 'create') {
                            Swal.fire({
                                toast: true,
                                position: 'top-end',
                                icon: 'success',
                                title: '¡Usuario creado!',
                                text: `${response.user.name} ha sido registrado exitosamente`,
                                showConfirmButton: false,
                                timer: 1000,
                                timerProgressBar: true
                            }).then(() => {
                                window.location.reload();
                            });
                        } else {
                            Swal.fire({
                                toast: true,
                                position: 'top-end',
                                icon: 'success',
                                title: '¡Usuario actualizado!',
                                text: `${response.user.name} ha sido actualizado exitosamente`,
                                showConfirmButton: false,
                                timer: 1000,
                                timerProgressBar: true
                            }).then(() => {
                                window.location.reload();
                            });
                        }
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        showValidationErrors(xhr.responseJSON.errors);
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Error al procesar la solicitud'
                        });
                    }
                }
            });
        });

        // Editar usuario  
        $(document).on('click', '.edit-user', function() {
            const userId = $(this).data('id');

            $.ajax({
                url: '{{ route("users.show", ":id") }}'.replace(':id', userId),
                method: 'GET',
                success: function(response) {
                    if (response.success) {
                        const user = response.user;

                        $('#userModalTitle').text('Editar Usuario');
                        $('#name').val(user.name);
                        $('#email').val(user.email);
                        $('#password').val('');
                        $('#role').val(user.roles[0]?.name || '');
                        $('#userId').val(user.id);
                        $('#userForm').attr('data-action', 'edit');
                        $('#passwordLabel').text('Nueva contraseña (opcional)');
                        $('#passwordHelp').text('Dejar vacío para mantener la contraseña actual');
                        $('#password').prop('required', false);

                        $('#userModal').removeClass('hidden opacity-0').addClass('flex opacity-100');
                        setTimeout(() => {
                            $('#userModal .bg-white').removeClass('scale-95').addClass('scale-100');
                        }, 10);
                    }
                }
            });
        });

        // Eliminar usuario  
        $(document).on('click', '.delete-user', function() {
            const userId = $(this).data('id');
            const userName = $(this).closest('tr').find('.text-sm.font-medium').first().text();

            Swal.fire({
                title: '¿Estás seguro?',
                text: `¿Quieres eliminar el usuario "${userName}"?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route("users.destroy", ":id") }}'.replace(':id', userId),
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire({
                                    toast: true,
                                    position: 'top-end',
                                    icon: 'success',
                                    title: '¡Eliminado!',
                                    text: 'El usuario ha sido eliminado exitosamente',
                                    showConfirmButton: false,
                                    timer: 1000,
                                    timerProgressBar: true
                                }).then(() => {
                                    window.location.reload();
                                });
                            }
                        },
                        error: function() {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Error al eliminar el usuario'
                            });
                        }
                    });
                }
            });
        });

        // Funciones auxiliares  
        function showValidationErrors(errors) {
            clearErrors();

            Object.keys(errors).forEach(function(field) {
                const errorElement = $('#' + field + 'Error');
                errorElement.text(errors[field][0]).removeClass('hidden');
                $('#' + field).addClass('border-red-500');
            });
        }

        function clearErrors() {
            $('.text-red-500').addClass('hidden');
            $('input').removeClass('border-red-500');
        }

        // Función para aplicar filtros  
        function applyFilters() {
            const search = $('#searchInput').val();
            const params = new URLSearchParams();

            if (search && search.trim() !== '') {
                params.append('search', search);
            }

            const url = window.location.pathname + (params.toString() ? '?' + params.toString() : '');
            window.location.href = url;
        }
    });
</script>
@endpush