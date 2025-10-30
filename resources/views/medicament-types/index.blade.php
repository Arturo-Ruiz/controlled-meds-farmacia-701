@extends('layouts.app')

@section('title', 'Tipos de Medicamentos')

@section('content')
<div class="animate-fadeInUp">
    <!-- Header -->
    <div class="bg-gradient-to-r from-lime-500 via-lime-600 to-green-600 rounded-2xl p-4 sm:p-6 lg:p-8 text-white shadow-2xl relative overflow-hidden mb-8">
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute -top-10 -right-10 w-32 h-32 bg-white/10 rounded-full blur-2xl animate-pulse"></div>
            <div class="absolute -bottom-10 -left-10 w-40 h-40 bg-white/5 rounded-full blur-3xl animate-pulse" style="animation-delay: 2s;"></div>
            <div class="absolute top-1/2 right-1/4 w-20 h-20 bg-white/5 rounded-full blur-xl animate-pulse" style="animation-delay: 4s;"></div>
        </div>

        <div class="relative z-10 flex flex-col lg:flex-row lg:items-center lg:justify-between space-y-4 lg:space-y-0">
            <div class="flex-1">
                <h1 class="text-xl sm:text-2xl lg:text-3xl font-bold mb-2">Gestión de Tipos de Medicamentos</h1>
                <p class="text-lime-100 text-sm sm:text-base lg:text-lg mb-4 lg:mb-0">Administra los tipos de medicamentos</p>
                <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-4 lg:space-x-6 space-y-2 sm:space-y-0 mt-4">
                    <div class="flex items-center space-x-2">
                        <i class="fas fa-tags text-lime-200"></i>
                        <span class="text-lime-100 text-xs sm:text-sm">{{ $medicamentTypes->total() ?? 0 }} tipos registrados</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <i class="fas fa-clock text-lime-200"></i>
                        <span class="text-lime-100 text-xs sm:text-sm">Actualizado {{ now()->translatedFormat('d/m/Y H:i') }}</span>
                    </div>
                </div>
            </div>
            <div class="flex items-center justify-center lg:justify-end">
                <button id="createMedicamentTypeBtn" class="bg-white/20 hover:bg-white/30 text-white px-4 sm:px-6 py-2 sm:py-3 rounded-xl font-medium transition-all duration-300 hover:scale-105 backdrop-blur-sm border border-white/20 shadow-lg text-sm sm:text-base w-full sm:w-auto">
                    <i class="fas fa-plus mr-2"></i>
                    <span class="hidden sm:inline">Nuevo Tipo</span>
                    <span class="sm:hidden">Nuevo</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Tabla de Tipos de Medicamentos con Filtros Integrados -->
    <div class="bg-white rounded-xl shadow-lg border border-gray-100">
        <div class="p-6 border-b border-gray-200">
            <!-- Header con título y filtros -->
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between space-y-4 lg:space-y-0">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Lista de Tipos de Medicamentos</h3>
                </div>

                <!-- Filtros en desktop (esquina superior derecha) -->
                <div class="hidden lg:flex items-center space-x-4">
                    <div class="w-64">
                        <label class="block text-xs font-medium text-gray-700 mb-1">Buscar tipo</label>
                        <div class="relative">
                            <input type="text" id="searchInput" placeholder="Nombre del tipo..."
                                class="w-full pl-8 pr-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                            <div class="absolute inset-y-0 left-0 pl-2 flex items-center">
                                <i class="fas fa-search text-gray-400 text-xs"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filtro centrado en móviles -->
            <div class="lg:hidden mt-4">
                <div class="flex justify-center">
                    <div class="w-full max-w-sm">
                        <label class="block text-sm font-medium text-gray-700 mb-2 text-center">Buscar tipo</label>
                        <div class="relative">
                            <input type="text" id="searchInputMobile" placeholder="Nombre del tipo..."
                                class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center">
                                <i class="fas fa-search text-gray-400"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if($medicamentTypes->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-tags text-lime-500"></i>
                                <span>Tipo de Medicamento</span>
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
                    @foreach($medicamentTypes as $medicamentType)
                    <tr class="hover:bg-gray-50 transition-colors duration-200">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-gradient-to-br from-lime-500 to-lime-600 rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas fa-tags text-white text-sm"></i>
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-900">{{ $medicamentType->name }}</div>
                                    <div class="text-sm text-gray-500">ID: {{ $medicamentType->id }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $medicamentType->created_at->format('d/m/Y') }}</div>
                            <div class="text-sm text-gray-500">{{ $medicamentType->created_at->format('H:i') }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <div class="flex items-center justify-center space-x-2">
                                <button class="edit-medicament-type p-2 text-lime-600 hover:text-lime-700 hover:bg-lime-50 rounded-lg transition-all duration-200"
                                    data-id="{{ $medicamentType->id }}"
                                    title="Editar tipo">
                                    <i class="fas fa-edit"></i>
                                </button>

                                <button class="delete-medicament-type p-2 text-red-600 hover:text-red-700 hover:bg-red-50 rounded-lg transition-all duration-200"
                                    data-id="{{ $medicamentType->id }}"
                                    title="Eliminar tipo">
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
                <i class="fas fa-tags text-gray-400 text-3xl"></i>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mb-2">No hay tipos de medicamentos registrados</h3>
            <p class="text-gray-500 mb-6">Comienza agregando tu primer tipo de medicamento</p>
            <button id="createMedicamentTypeBtn" class="bg-lime-600 hover:bg-lime-700 text-white px-6 py-3 rounded-xl font-medium transition-colors duration-200">
                <i class="fas fa-plus mr-2"></i>
                Agregar Tipo
            </button>
        </div>
        @endif

        <!-- Paginación -->
        @if($medicamentTypes->hasPages())
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $medicamentTypes->links() }}
        </div>
        @endif
    </div>
</div>

<!-- Modal -->
<div id="medicamentTypeModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center transition-opacity duration-300 opacity-0">
    <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full mx-4 max-h-[90vh] overflow-y-auto animate-fadeInUp">
        <div class="flex items-center justify-between p-6 border-b border-gray-200">
            <h3 id="medicamentTypeModalTitle" class="text-xl font-semibold text-gray-900">Crear Tipo de Medicamento</h3>
            <button class="modal-close p-2 hover:bg-gray-100 rounded-lg transition-colors duration-200">
                <i class="fas fa-times text-gray-500"></i>
            </button>
        </div>

        <form id="medicamentTypeForm" class="px-6 py-4">
            @csrf
            <input type="hidden" id="medicamentTypeId" name="id">

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nombre del tipo</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center">
                        <i class="fas fa-tags text-gray-400"></i>
                    </div>
                    <input type="text" id="name" name="name" required
                        class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-lime-500 focus:border-lime-500">
                    <span class="text-red-500 text-xs hidden" id="nameError"></span>
                </div>
            </div>
        </form>

        <div class="px-6 py-4 border-t border-gray-200 flex justify-end space-x-3">
            <button id="cancelBtn" class="px-4 py-2 text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg transition-colors duration-200">
                Cancelar
            </button>
            <button id="saveBtn" class="px-4 py-2 bg-lime-600 hover:bg-lime-700 text-white rounded-lg transition-colors duration-200">
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

    #medicamentTypeModal:not(.hidden) {
        backdrop-filter: blur(4px);
        background-color: rgba(0, 0, 0, 0.3);
    }

    /* Animación de entrada del modal */
    #medicamentTypeModal .bg-white {
        transform: scale(0.95);
        opacity: 0;
        transition: opacity 0.3s ease-in-out;
    }

    #medicamentTypeModal:not(.hidden) .bg-white {
        transform: scale(1);
        opacity: 1;
    }

    #medicamentTypeModal {
        transition: opacity 0.3s ease-in-out, backdrop-filter 0.3s ease-in-out;
    }

    #medicamentTypeModal .bg-white {
        transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.3s ease-in-out;
    }
</style>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Función para verificar si hay filtros activos  
        function hasActiveFilters() {
            const search = $('#searchInput').val();
            return (search && search.trim() !== '');
        }

        // Función para mostrar filtros automáticamente si están activos  
        function autoExpandFiltersIfActive() {
            // En tipos de medicamentos no tienes filtros colapsables, pero mantenemos la función para consistencia  
            return;
        }

        // Mantener valores de filtros después de la recarga  
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.get('search')) {
            const searchValue = urlParams.get('search');
            $('#searchInput').val(searchValue);
            $('#searchInputMobile').val(searchValue);
        }

        // Expandir automáticamente si hay filtros activos  
        autoExpandFiltersIfActive();

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

        // Abrir modal para crear  
        $(document).on('click', '#createMedicamentTypeBtn', function() {
            $('#medicamentTypeModalTitle').text('Nuevo Tipo de Medicamento');
            $('#medicamentTypeForm')[0].reset();
            $('#medicamentTypeForm').attr('data-action', 'create');
            $('#medicamentTypeId').val('');
            clearErrors();

            $('#medicamentTypeModal').removeClass('hidden opacity-0').addClass('flex opacity-100');
            setTimeout(() => {
                $('#medicamentTypeModal .bg-white').removeClass('scale-95').addClass('scale-100');
            }, 10);
        });

        // Cerrar modal  
        $('#cancelBtn, .modal-close').click(function() {
            closeModal();
        });

        function closeModal() {
            // Animar el contenido del modal más rápido  
            $('#medicamentTypeModal .bg-white').css({
                'transform': 'scale(0.95)',
                'opacity': '0.8'
            });

            // Desvanecer el backdrop rápidamente  
            setTimeout(() => {
                $('#medicamentTypeModal').css('opacity', '0');
                $('#medicamentTypeModal .bg-white').css({
                    'transform': 'scale(0.9)',
                    'opacity': '0'
                });
            }, 100);

            // Ocultar completamente y resetear  
            setTimeout(() => {
                $('#medicamentTypeModal').removeClass('flex opacity-100').addClass('hidden opacity-0');
                // Resetear estilos para la próxima apertura  
                $('#medicamentTypeModal .bg-white').css({
                    'transform': '',
                    'opacity': ''
                }).removeClass('scale-95').addClass('scale-100');
                $('#medicamentTypeModal').css('opacity', '');
            }, 200);

            clearErrors();
        }

        // Manejar Enter para enviar el formulario  
        $('#medicamentTypeForm').on('keypress', function(e) {
            if (e.which === 13) {
                e.preventDefault();
                $('#saveBtn').click();
            }
        });

        $('#medicamentTypeModal').on('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });

        // Guardar tipo de medicamento  
        $('#saveBtn').click(function() {
            const form = $('#medicamentTypeForm');
            const action = form.attr('data-action');
            const medicamentTypeId = $('#medicamentTypeId').val();

            let url = action === 'create' ? '{{ route("medicament-types.store") }}' :
                '{{ route("medicament-types.update", ":id") }}'.replace(':id', medicamentTypeId);
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
                                title: '¡Tipo creado!',
                                text: `${response.medicamentType.name} ha sido registrado exitosamente`,
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
                                title: '¡Tipo actualizado!',
                                text: `${response.medicamentType.name} ha sido actualizado exitosamente`,
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

        // Editar tipo de medicamento  
        $(document).on('click', '.edit-medicament-type', function() {
            const medicamentTypeId = $(this).data('id');

            $.ajax({
                url: '{{ route("medicament-types.show", ":id") }}'.replace(':id', medicamentTypeId),
                method: 'GET',
                success: function(response) {
                    if (response.success) {
                        const medicamentType = response.medicamentType;

                        $('#medicamentTypeModalTitle').text('Editar Tipo de Medicamento');
                        $('#name').val(medicamentType.name);
                        $('#medicamentTypeId').val(medicamentType.id);
                        $('#medicamentTypeForm').attr('data-action', 'edit');

                        $('#medicamentTypeModal').removeClass('hidden opacity-0').addClass('flex opacity-100');
                        setTimeout(() => {
                            $('#medicamentTypeModal .bg-white').removeClass('scale-95').addClass('scale-100');
                        }, 10);
                    }
                }
            });
        });

        // Eliminar tipo de medicamento  
        $(document).on('click', '.delete-medicament-type', function() {
            const medicamentTypeId = $(this).data('id');
            const medicamentTypeName = $(this).closest('tr').find('.text-sm.font-medium').text();

            Swal.fire({
                title: '¿Estás seguro?',
                text: `¿Quieres eliminar el tipo "${medicamentTypeName}"?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route("medicament-types.destroy", ":id") }}'.replace(':id', medicamentTypeId),
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
                                    text: 'El tipo ha sido eliminado exitosamente',
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
                                text: 'Error al eliminar el tipo'
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