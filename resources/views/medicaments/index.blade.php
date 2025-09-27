@extends('layouts.app')

@section('title', 'Medicamentos')

@section('content')
<div class="animate-fadeInUp">
    <div class="bg-gradient-to-r from-blue-500 via-blue-600 to-indigo-600 rounded-2xl p-8 text-white shadow-2xl relative overflow-hidden mb-8">
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute -top-10 -right-10 w-32 h-32 bg-white/10 rounded-full blur-2xl animate-pulse"></div>
            <div class="absolute -bottom-10 -left-10 w-40 h-40 bg-white/5 rounded-full blur-3xl animate-pulse" style="animation-delay: 2s;"></div>
            <div class="absolute top-1/2 right-1/4 w-20 h-20 bg-white/5 rounded-full blur-xl animate-pulse" style="animation-delay: 4s;"></div>
        </div>

        <div class="relative z-10 flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold mb-2">Gestión de Medicamentos</h1>
                <p class="text-blue-100 text-lg">Administra el inventario de medicamentos de la farmacia</p>
                <div class="flex items-center space-x-6 mt-4">
                    <div class="flex items-center space-x-2">
                        <i class="fas fa-pills text-blue-200"></i>
                        <span class="text-blue-100">{{ $medicaments->total() ?? 0 }} medicamentos registrados</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <i class="fas fa-clock text-blue-200"></i>
                        <span class="text-blue-100">Actualizado {{ now()->format('d/m/Y H:i') }}</span>
                    </div>
                </div>
            </div>
            <div class="flex items-center space-x-4">
                <button id="createMedicamentBtn" class="bg-white/20 hover:bg-white/30 text-white px-6 py-3 rounded-xl font-medium transition-all duration-300 hover:scale-105 backdrop-blur-sm border border-white/20 shadow-lg">
                    <i class="fas fa-plus mr-2"></i>
                    Nuevo Medicamento
                </button>
            </div>
        </div>
    </div>


    <!-- Filtros y Búsqueda -->
    <div class="bg-white rounded-xl shadow-lg p-6 mb-8 border border-gray-100">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Buscar medicamento</label>
                <div class="relative">
                    <input type="text" id="searchInput" placeholder="Nombre del medicamento..."
                        class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Estado del stock</label>
                <select id="statusFilter" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="all">Todos los estados</option>
                    <option value="normal">Stock normal</option>
                    <option value="low">Stock bajo</option>
                    <option value="critical">Stock crítico</option>
                </select>
            </div>

            <div class="flex items-end">
                <button id="applyFilters" class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors duration-200 flex items-center justify-center">
                    <i class="fas fa-filter mr-2"></i>
                    Aplicar Filtros
                </button>
            </div>
        </div>
    </div>

    <!-- Lista de Medicamentos -->
    <div class="bg-white rounded-xl shadow-lg border border-gray-100">
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Lista de Medicamentos</h3>
        </div>

        <!-- Grid de Medicamentos Mejorado -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="medicamentsGrid">
            @forelse($medicaments as $medicament)
            <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-1 border border-gray-100 overflow-hidden group">
                <!-- Header de la tarjeta con gradiente sutil -->
                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 p-4 border-b border-gray-100">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center shadow-lg">
                                <i class="fas fa-pills text-white text-lg"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900 text-lg group-hover:text-blue-700 transition-colors duration-200">
                                    {{ $medicament->name }}
                                </h3>
                                <p class="text-sm text-gray-600">{{ $medicament->presentation }}</p>
                            </div>
                        </div>

                        <!-- Badge de estado -->
                        @if($medicament->stock <= $medicament->min_stock)
                            <span class="px-3 py-1 bg-red-100 text-red-700 text-xs font-semibold rounded-full border border-red-200">
                                <i class="fas fa-exclamation-triangle mr-1"></i>
                                Stock Crítico
                            </span>
                            @elseif($medicament->stock <= ($medicament->min_stock * 1.5))
                                <span class="px-3 py-1 bg-yellow-100 text-yellow-700 text-xs font-semibold rounded-full border border-yellow-200">
                                    <i class="fas fa-exclamation-circle mr-1"></i>
                                    Stock Bajo
                                </span>
                                @else
                                <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-full border border-green-200">
                                    <i class="fas fa-check-circle mr-1"></i>
                                    Stock Normal
                                </span>
                                @endif
                    </div>
                </div>

                <!-- Contenido principal -->
                <div class="p-6 space-y-4">
                    <!-- Información de stock -->
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-gray-50 rounded-xl p-3 text-center">
                            <p class="text-xs text-gray-500 uppercase tracking-wide font-medium mb-1">Stock Actual</p>
                            <p class="text-2xl font-bold text-gray-900">{{ number_format($medicament->stock) }}</p>
                            <p class="text-xs text-gray-600">unidades</p>
                        </div>
                        <div class="bg-gray-50 rounded-xl p-3 text-center">
                            <p class="text-xs text-gray-500 uppercase tracking-wide font-medium mb-1">Stock Mínimo</p>
                            <p class="text-2xl font-bold text-gray-900">{{ number_format($medicament->min_stock) }}</p>
                            <p class="text-xs text-gray-600">unidades</p>
                        </div>
                    </div>

                    <!-- Información adicional -->
                    <div class="space-y-3">
                        <div class="flex items-center justify-between py-2 border-b border-gray-100">
                            <span class="text-sm text-gray-600 flex items-center">
                                <i class="fas fa-dollar-sign text-green-500 mr-2"></i>
                                Precio
                            </span>
                            <span class="font-semibold text-green-600">${{ number_format($medicament->price, 2) }}</span>
                        </div>

                        <div class="flex items-center justify-between py-2 border-b border-gray-100">
                            <span class="text-sm text-gray-600 flex items-center">
                                <i class="fas fa-calendar-alt text-blue-500 mr-2"></i>
                                Vencimiento
                            </span>
                            <span class="font-medium text-gray-900">{{ $medicament->expiration_date->format('d/m/Y') }}</span>
                        </div>

                        <div class="flex items-center justify-between py-2">
                            <span class="text-sm text-gray-600 flex items-center">
                                <i class="fas fa-capsules text-purple-500 mr-2"></i>
                                Unidades Posológicas
                            </span>
                            <span class="font-medium text-gray-900">{{ $medicament->posological_units }}</span>
                        </div>
                    </div>
                </div>

                <!-- Footer con acciones -->
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-100">
                    <div class="flex items-center justify-between">
                        <div class="flex space-x-2">
                            <button class="edit-medicament p-2 text-blue-600 hover:text-blue-700 hover:bg-blue-50 rounded-lg transition-all duration-200"
                                data-id="{{ $medicament->id }}"
                                title="Editar medicamento">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="delete-medicament p-2 text-red-600 hover:text-red-700 hover:bg-red-50 rounded-lg transition-all duration-200"
                                data-id="{{ $medicament->id }}"
                                title="Eliminar medicamento">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>

                        <!-- Indicador de días hasta vencimiento -->
                        @php
                        $daysToExpire = now()->diffInDays($medicament->expiration_date, false);
                        @endphp

                        @if($daysToExpire < 30)
                            <span class="text-xs text-red-600 font-medium">
                            <i class="fas fa-clock mr-1"></i>
                            Vence en {{ $daysToExpire }} días
                            </span>
                            @elseif($daysToExpire < 90)
                                <span class="text-xs text-yellow-600 font-medium">
                                <i class="fas fa-clock mr-1"></i>
                                Vence en {{ $daysToExpire }} días
                                </span>
                                @else
                                <span class="text-xs text-gray-500">
                                    <i class="fas fa-clock mr-1"></i>
                                    {{ $daysToExpire }} días restantes
                                </span>
                                @endif
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-12">
                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-pills text-gray-400 text-3xl"></i>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">No hay medicamentos registrados</h3>
                <p class="text-gray-500 mb-6">Comienza agregando tu primer medicamento al inventario</p>
                <button id="createMedicamentBtn" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl font-medium transition-colors duration-200">
                    <i class="fas fa-plus mr-2"></i>
                    Agregar Medicamento
                </button>
            </div>
            @endforelse
        </div>

        <!-- Paginación -->
        @if($medicaments->hasPages())
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $medicaments->links() }}
        </div>
        @endif


    </div>
</div>


<!-- Modal de Medicamentos - Versión Sin Overlay -->
<div id="medicamentModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center transition-opacity duration-300 opacity-0">
    <!-- Modal Content -->
    <div class="bg-white rounded-2xl shadow-2xl max-w-2xl w-full mx-4 max-h-[90vh] overflow-y-auto animate-fadeInUp">
        <!-- Header del Modal -->
        <div class="flex items-center justify-between p-6 border-b border-gray-200">
            <h3 id="medicamentModalTitle" class="text-xl font-semibold text-gray-900">Crear Medicamento</h3>
            <button class="modal-close p-2 hover:bg-gray-100 rounded-lg transition-colors duration-200">
                <i class="fas fa-times text-gray-500"></i>
            </button>
        </div>

        <!-- Resto del contenido del modal igual que antes -->
        <form id="medicamentForm" class="px-6 py-4">
            @csrf
            <input type="hidden" id="medicamentId" name="id">

            <!-- Primera fila: Nombre y Presentación -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nombre del medicamento</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center">
                            <i class="fas fa-pills text-gray-400"></i>
                        </div>
                        <input type="text" id="name" name="name" required
                            class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <span class="text-red-500 text-xs hidden" id="nameError"></span>
                    </div>
                </div>

                <div>
                    <label for="presentation" class="block text-sm font-medium text-gray-700 mb-1">Presentación</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center">
                            <i class="fas fa-capsules text-gray-400"></i>
                        </div>
                        <input type="text" id="presentation" name="presentation" required
                            placeholder="Ej: Tabletas, Jarabe, Cápsulas"
                            class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <span class="text-red-500 text-xs hidden" id="presentationError"></span>
                    </div>
                </div>
            </div>

            <!-- Segunda fila: Unidades posológicas y Precio -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="posological_units" class="block text-sm font-medium text-gray-700 mb-1">Unidades posológicas</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center">
                            <i class="fas fa-hashtag text-gray-400"></i>
                        </div>
                        <input type="number" id="posological_units" name="posological_units" required min="1"
                            class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <span class="text-red-500 text-xs hidden" id="posological_unitsError"></span>
                    </div>
                </div>

                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Precio</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center">
                            <i class="fas fa-dollar-sign text-gray-400"></i>
                        </div>
                        <input type="number" id="price" name="price" required min="0" step="0.01"
                            class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <span class="text-red-500 text-xs hidden" id="priceError"></span>
                    </div>
                </div>
            </div>

            <!-- Tercera fila: Stock actual y Stock mínimo -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="stock" class="block text-sm font-medium text-gray-700 mb-1">Stock actual</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center">
                            <i class="fas fa-boxes text-gray-400"></i>
                        </div>
                        <input type="number" id="stock" name="stock" required min="0"
                            class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <span class="text-red-500 text-xs hidden" id="stockError"></span>
                    </div>
                </div>

                <div>
                    <label for="min_stock" class="block text-sm font-medium text-gray-700 mb-1">Stock mínimo</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center">
                            <i class="fas fa-exclamation-triangle text-gray-400"></i>
                        </div>
                        <input type="number" id="min_stock" name="min_stock" required min="0"
                            class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <span class="text-red-500 text-xs hidden" id="min_stockError"></span>
                    </div>
                </div>
            </div>

            <!-- Cuarta fila: Fecha de vencimiento (ancho completo) -->
            <div class="mb-4">
                <label for="expiration_date" class="block text-sm font-medium text-gray-700 mb-1">Fecha de vencimiento</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center">
                        <i class="fas fa-calendar-alt text-gray-400"></i>
                    </div>
                    <input type="date" id="expiration_date" name="expiration_date" required
                        class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <span class="text-red-500 text-xs hidden" id="expiration_dateError"></span>
                </div>
            </div>
        </form>

        <div class="px-6 py-4 border-t border-gray-200 flex justify-end space-x-3">
            <button id="cancelBtn" class="px-4 py-2 text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg transition-colors duration-200">
                Cancelar
            </button>
            <button id="saveBtn" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors duration-200">
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

    .hover-card {
        transition: all 0.3s ease;
    }

    .hover-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }

    .status-badge {
        animation: pulse 2s infinite;
    }

    @keyframes pulse {

        0%,
        100% {
            opacity: 1;
        }

        50% {
            opacity: 0.8;
        }
    }

    /* Modal backdrop blur effect */
    #medicamentModal:not(.hidden) {
        backdrop-filter: blur(4px);
        background-color: rgba(255, 255, 255, 0.1);
    }

    /* Animación de entrada del modal */
    #medicamentModal .bg-white {
        transform: scale(0.95);
        opacity: 0;
        transition: opacity 0.3s ease-in-out;
    }

    #medicamentModal:not(.hidden) .bg-white {
        transform: scale(1);
        opacity: 1;
    }

    #medicamentModal .bg-white {
        animation-duration: 0.4s;
        animation-timing-function: ease-out;
    }
</style>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Abrir modal para crear  
        $('#createMedicamentBtn').click(function() {
            $('#modalTitle').text('Nuevo Medicamento');
            $('#medicamentForm')[0].reset();
            $('#medicamentForm').attr('data-action', 'create');
            $('#medicamentId').val('');
            clearErrors();

            // Mostrar modal con fade in  
            $('#medicamentModal').removeClass('hidden opacity-0').addClass('flex opacity-100');
            setTimeout(() => {
                $('#medicamentModal .bg-white').removeClass('scale-95').addClass('scale-100');
            }, 10);
        });

        // Cerrar modal  
        $('#cancelBtn, .modal-close').click(function() {
            closeModal();
        });

        // Función para cerrar modal  
        function closeModal() {
            $('#medicamentModal .bg-white').removeClass('scale-100').addClass('scale-95');
            setTimeout(() => {
                $('#medicamentModal').removeClass('flex opacity-100').addClass('hidden opacity-0');
            }, 200);
            clearErrors();
        }

        // Guardar medicamento  
        $('#saveBtn').click(function() {
            const form = $('#medicamentForm');
            const action = form.attr('data-action');
            const medicamentId = $('#medicamentId').val();

            let url = action === 'create' ? '{{ route("medicaments.store") }}' :
                '{{ route("medicaments.update", ":id") }}'.replace(':id', medicamentId);

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
                            // Agregar nueva tarjeta al grid  
                            addMedicamentToGrid(response.medicament);

                            // Toast de éxito  
                            Swal.fire({
                                toast: true,
                                position: 'top-end',
                                icon: 'success',
                                title: '¡Medicamento creado!',
                                text: `${response.medicament.name} ha sido registrado exitosamente`,
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true
                            });
                        } else {
                            // Actualizar tarjeta existente  
                            updateMedicamentCard(response.medicament);

                            // Toast de éxito para edición  
                            Swal.fire({
                                toast: true,
                                position: 'top-end',
                                icon: 'success',
                                title: '¡Medicamento actualizado!',
                                text: `${response.medicament.name} ha sido actualizado exitosamente`,
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true
                            });
                        }
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        const errors = xhr.responseJSON.errors;
                        showValidationErrors(errors);
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

        // Editar medicamento  
        $(document).on('click', '.edit-medicament', function() {
            const medicamentId = $(this).data('id');

            $.ajax({
                url: '{{ route("medicaments.show", ":id") }}'.replace(':id', medicamentId),
                method: 'GET',
                success: function(response) {
                    if (response.success) {
                        const medicament = response.medicament;

                        $('#modalTitle').text('Editar Medicamento');
                        $('#name').val(medicament.name);
                        $('#presentation').val(medicament.presentation);
                        $('#posological_units').val(medicament.posological_units);
                        $('#stock').val(medicament.stock);
                        $('#min_stock').val(medicament.min_stock);
                        $('#price').val(medicament.price);
                        $('#expiration_date').val(medicament.expiration_date);
                        $('#medicamentId').val(medicament.id);

                        $('#medicamentForm').attr('data-action', 'edit');

                        // Mostrar modal  
                        $('#medicamentModal').removeClass('hidden opacity-0').addClass('flex opacity-100');
                        setTimeout(() => {
                            $('#medicamentModal .bg-white').removeClass('scale-95').addClass('scale-100');
                        }, 10);
                    }
                }
            });
        });

        // Eliminar medicamento  
        $(document).on('click', '.delete-medicament', function() {
            const medicamentId = $(this).data('id');
            const medicamentName = $(this).closest('.bg-white').find('h3').text();

            Swal.fire({
                title: '¿Estás seguro?',
                text: `¿Quieres eliminar el medicamento "${medicamentName}"?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route("medicaments.destroy", ":id") }}'.replace(':id', medicamentId),
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            if (response.success) {
                                // Remover tarjeta del DOM con animación  
                                const card = $(`.delete-medicament[data-id="${medicamentId}"]`).closest('.bg-white').parent();
                                card.fadeOut(300, function() {
                                    $(this).remove();
                                });

                                Swal.fire({
                                    toast: true,
                                    position: 'top-end',
                                    icon: 'success',
                                    title: '¡Eliminado!',
                                    text: 'El medicamento ha sido eliminado exitosamente',
                                    showConfirmButton: false,
                                    timer: 3000,
                                    timerProgressBar: true
                                });
                            }
                        },
                        error: function() {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Error al eliminar el medicamento'
                            });
                        }
                    });
                }
            });
        });

        // Función para agregar medicamento al grid  
        function addMedicamentToGrid(medicament) {
            // Busca y elimina el mensaje de "grid vacío" si existe
            const emptyState = $('#medicamentsGrid').find('.col-span-full');
            if (emptyState.length) {
                emptyState.remove();
            }

            const newCard = createMedicamentCard(medicament);
            $('#medicamentsGrid').prepend(newCard);

            // Animación de entrada
            setTimeout(() => {
                newCard.removeClass('opacity-0 scale-95').addClass('opacity-100 scale-100');
            }, 100);
        }

        // Función para actualizar tarjeta existente  
        function updateMedicamentCard(medicament) {
            const existingCard = $(`.edit-medicament[data-id="${medicament.id}"]`).closest('.bg-white').parent();
            const newCard = createMedicamentCard(medicament);

            existingCard.fadeOut(200, function() {
                existingCard.replaceWith(newCard);
                newCard.hide().fadeIn(200);
            });
        }

        // Función para crear tarjeta de medicamento  
        function createMedicamentCard(medicament) {
            // Calcular estado del medicamento  
            const isLowStock = medicament.stock <= medicament.min_stock;
            const expirationDate = new Date(medicament.expiration_date);
            const today = new Date();
            const diffTime = expirationDate - today;
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

            let statusBadge = '';
            let statusColor = '';

            if (isLowStock) {
                statusBadge = '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">Stock bajo</span>';
                statusColor = 'from-red-500 to-red-600';
            } else if (diffDays <= 30) {
                statusBadge = '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">Próximo a vencer</span>';
                statusColor = 'from-yellow-500 to-yellow-600';
            } else {
                statusBadge = '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Normal</span>';
                statusColor = 'from-blue-500 to-blue-600';
            }

            // Formatear fecha  
            const formattedDate = new Date(medicament.expiration_date).toLocaleDateString('es-ES');

            // Formatear precio  
            const formattedPrice = new Intl.NumberFormat('es-ES', {
                style: 'currency',
                currency: 'USD'
            }).format(medicament.price);

            return $(`  
            <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-1 border border-gray-100 overflow-hidden group opacity-0 scale-95 transform">  
                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 p-4 border-b border-gray-100">  
                    <div class="flex items-center justify-between">  
                        <div class="flex items-center space-x-3">  
                            <div class="w-12 h-12 bg-gradient-to-br ${statusColor} rounded-xl flex items-center justify-center shadow-lg">  
                                <i class="fas fa-pills text-white text-lg"></i>  
                            </div>  
                            <div>  
                                <h3 class="text-lg font-bold text-gray-900 group-hover:text-blue-600 transition-colors duration-300">${medicament.name}</h3>  
                                <p class="text-sm text-gray-600">${medicament.presentation}</p>  
                            </div>  
                        </div>  
                        ${statusBadge}  
                    </div>  
                </div>  
  
                <div class="p-6 space-y-4">  
                    <div class="grid grid-cols-2 gap-4">  
                        <div class="bg-gray-50 rounded-lg p-3">  
                            <div class="flex items-center space-x-2 mb-1">  
                                <i class="fas fa-boxes text-blue-500 text-sm"></i>  
                                <span class="text-xs font-medium text-gray-500 uppercase tracking-wider">Stock</span>  
                            </div>  
                            <p class="text-lg font-bold text-gray-900">${medicament.stock}</p>  
                            <p class="text-xs text-gray-500">Mín: ${medicament.min_stock}</p>  
                        </div>  
  
                        <div class="bg-gray-50 rounded-lg p-3">  
                            <div class="flex items-center space-x-2 mb-1">  
                                <i class="fas fa-tag text-green-500 text-sm"></i>  
                                <span class="text-xs font-medium text-gray-500 uppercase tracking-wider">Precio</span>  
                            </div>  
                            <p class="text-lg font-bold text-gray-900">${formattedPrice}</p>  
                        </div>  
                    </div>  
  
                    <div class="bg-gray-50 rounded-lg p-3">  
                        <div class="flex items-center space-x-2 mb-1">  
                            <i class="fas fa-calendar-alt text-purple-500 text-sm"></i>  
                            <span class="text-xs font-medium text-gray-500 uppercase tracking-wider">Vencimiento</span>  
                        </div>  
                        <p class="text-sm font-semibold text-gray-900">${formattedDate}</p>  
                        <p class="text-xs text-gray-500">${medicament.posological_units} unidades posológicas</p>  
                    </div>  
                </div>  
  
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex justify-between items-center">  
                    <div class="flex space-x-2">  
                        <button class="edit-medicament bg-blue-100 hover:bg-blue-200 text-blue-700 p-2 rounded-lg transition-colors duration-200" data-id="${medicament.id}">  
                            <i class="fas fa-edit text-sm"></i>  
                        </button>  
                        <button class="delete-medicament bg-red-100 hover:bg-red-200 text-red-700 p-2 rounded-lg transition-colors duration-200" data-id="${medicament.id}">  
                            <i class="fas fa-trash text-sm"></i>  
                        </button>  
                    </div>  
                    <div class="text-xs text-gray-500">  
                        ID: ${medicament.id}  
                    </div>  
                </div>  
            </div>  
        `);
        }

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
    });
</script>
@endpush