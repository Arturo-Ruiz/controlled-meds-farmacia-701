@extends('layouts.app')

@section('title', 'Salidas')

@section('content')
<div class="animate-fadeInUp">
    <!-- Header -->
    <div class="bg-gradient-to-r from-orange-500 via-orange-600 to-red-600 rounded-2xl p-4 sm:p-6 lg:p-8 text-white shadow-2xl relative overflow-hidden mb-8">
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute -top-10 -right-10 w-32 h-32 bg-white/10 rounded-full blur-2xl animate-pulse"></div>
            <div class="absolute -bottom-10 -left-10 w-40 h-40 bg-white/5 rounded-full blur-3xl animate-pulse" style="animation-delay: 2s;"></div>
            <div class="absolute top-1/2 right-1/4 w-20 h-20 bg-white/5 rounded-full blur-xl animate-pulse" style="animation-delay: 4s;"></div>
        </div>

        <div class="relative z-10 flex flex-col lg:flex-row lg:items-center lg:justify-between space-y-4 lg:space-y-0">
            <div class="flex-1">
                <h1 class="text-xl sm:text-2xl lg:text-3xl font-bold mb-2">Gestión de Salidas</h1>
                <p class="text-orange-100 text-sm sm:text-base lg:text-lg mb-4 lg:mb-0">Administra las salidas de medicamentos</p>
                <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-4 lg:space-x-6 space-y-2 sm:space-y-0 mt-4">
                    <div class="flex items-center space-x-2">
                        <i class="fas fa-arrow-up text-orange-200"></i>
                        <span class="text-orange-100 text-xs sm:text-sm">{{ $dispatches->total() ?? 0 }} salidas registradas</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <i class="fas fa-clock text-orange-200"></i>
                        <span class="text-orange-100 text-xs sm:text-sm">Actualizado {{ now()->translatedFormat('d/m/Y H:i') }}</span>
                    </div>
                </div>
            </div>
            <div class="flex items-center justify-center lg:justify-end">
                <button id="createDispatchBtn" class="bg-white/20 hover:bg-white/30 text-white px-4 sm:px-6 py-2 sm:py-3 rounded-xl font-medium transition-all duration-300 hover:scale-105 backdrop-blur-sm border border-white/20 shadow-lg text-sm sm:text-base w-full sm:w-auto">
                    <i class="fas fa-plus mr-2"></i>
                    <span class="hidden sm:inline">Nueva Salida</span>
                    <span class="sm:hidden">Nueva</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Tabla de Salidas -->
    <div class="bg-white rounded-xl shadow-lg border border-gray-100">
        <div class="p-6 border-b border-gray-200">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between space-y-4 lg:space-y-0">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Lista de Salidas</h3>
                </div>

                <!-- Filtros en desktop -->
                <div class="hidden lg:flex items-center space-x-4">
                    <div class="w-64">
                        <label class="block text-xs font-medium text-gray-700 mb-1">Buscar salida</label>
                        <div class="relative">
                            <input type="text" id="searchInput" placeholder="Medicamento, usuario o motivo..."
                                class="w-full pl-8 pr-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                            <div class="absolute inset-y-0 left-0 pl-2 flex items-center">
                                <i class="fas fa-search text-gray-400 text-xs"></i>
                            </div>
                        </div>
                    </div>

                    <div class="w-48">
                        <label class="block text-xs font-medium text-gray-700 mb-1">Filtrar por fecha</label>
                        <select id="dateFilter" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                            <option value="all">Todas las fechas</option>
                            <option value="this_month">Este mes</option>
                            <option value="last_3_months">Últimos 3 meses</option>
                            <option value="last_6_months">Últimos 6 meses</option>
                            <option value="this_year">Este año</option>
                        </select>
                    </div>
                </div>

            </div>

            <!-- Filtros en móvil -->
            <div class="lg:hidden mt-4">
                <div class="space-y-4">
                    <div class="w-full">
                        <label class="block text-xs font-medium text-gray-700 mb-1">Buscar salida</label>
                        <div class="relative">
                            <input type="text" id="searchInputMobile" placeholder="Medicamento, usuario o motivo..."
                                class="w-full pl-8 pr-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                            <div class="absolute inset-y-0 left-0 pl-2 flex items-center">
                                <i class="fas fa-search text-gray-400 text-xs"></i>
                            </div>
                        </div>
                    </div>

                    <!-- AGREGAR ESTE FILTRO DE FECHA MÓVIL -->
                    <div class="w-full">
                        <label class="block text-xs font-medium text-gray-700 mb-1">Filtrar por fecha</label>
                        <select id="dateFilterMobile" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                            <option value="all">Todas las fechas</option>
                            <option value="this_month">Este mes</option>
                            <option value="last_3_months">Últimos 3 meses</option>
                            <option value="last_6_months">Últimos 6 meses</option>
                            <option value="this_year">Este año</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        @if($dispatches->count() > 0)
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-pills text-gray-400"></i>
                                <span>Medicamento</span>
                            </div>
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-user text-gray-400"></i>
                                <span>Responsable</span>
                            </div>
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-boxes text-gray-400"></i>
                                <span>Cantidad</span>
                            </div>
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-chart-line text-gray-400"></i>
                                <span>Stock Anterior</span>
                            </div>
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-chart-bar text-gray-400"></i>
                                <span>Stock Final</span>
                            </div>
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-clipboard-list text-gray-400"></i>
                                <span>Razón</span>
                            </div>
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-calendar text-gray-400"></i>
                                <span>Fecha</span>
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
                    @foreach($dispatches as $dispatch)
                    <tr class="hover:bg-gray-50 transition-colors duration-200">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-gradient-to-br from-orange-500 to-orange-600 rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas fa-pills text-white text-sm"></i>
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-900">{{ $dispatch->medicament->name }}</div>
                                    <div class="text-sm text-gray-500">{{ $dispatch->medicament->presentation }}</div>
                                    <div class="text-xs text-gray-500 flex items-center mt-1">
                                        <i class="fas fa-capsules text-purple-500 mr-1"></i>
                                        {{ $dispatch->medicament->posological_units }} unidades posológicas
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $dispatch->user->name }}</div>
                        </td>


                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center space-x-2">
                                <div class="flex items-center px-2 py-1 bg-red-100 text-red-800 text-xs font-medium rounded-full">
                                    <i class="fas fa-minus mr-1"></i>
                                    {{ number_format($dispatch->amount) }}
                                    unidades
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ number_format($dispatch->current_stock) }}</div>
                            <div class="text-sm text-gray-500">unidades</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ number_format($dispatch->final_stock) }}</div>
                            <div class="text-sm text-gray-500">unidades</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($dispatch->reason === 'Venta')
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                <i class="fas fa-shopping-cart mr-1"></i>
                                Venta
                            </span>
                            @elseif($dispatch->reason === 'Medicamento Vencido')
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                <i class="fas fa-exclamation-triangle mr-1"></i>
                                Vencido
                            </span>
                            @else
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                <i class="fas fa-tools mr-1"></i>
                                Error Inventario
                            </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $dispatch->created_at->format('d/m/Y') }}</div>
                            <div class="text-sm text-gray-500">{{ $dispatch->created_at->format('H:i') }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <div class="flex items-center justify-center space-x-2">
                                <button class="delete-dispatch p-2 text-red-600 hover:text-red-700 hover:bg-red-50 rounded-lg transition-all duration-200"
                                    data-id="{{ $dispatch->id }}"
                                    title="Eliminar salida">
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
                <i class="fas fa-arrow-up text-gray-400 text-3xl"></i>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mb-2">No hay salidas registradas</h3>
            <p class="text-gray-500 mb-6">Comienza registrando tu primera salida</p>
            <button id="createDispatchBtn" class="bg-orange-600 hover:bg-orange-700 text-white px-6 py-3 rounded-xl font-medium transition-colors duration-200">
                <i class="fas fa-plus mr-2"></i>
                Registrar Salida
            </button>
        </div>
        @endif

        <!-- Paginación -->
        @if($dispatches->hasPages())
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $dispatches->links() }}
        </div>
        @endif
    </div>
</div>

<div id="dispatchModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center transition-opacity duration-300 opacity-0">
    <div class="bg-white rounded-2xl shadow-2xl max-w-2xl w-full mx-4 max-h-[90vh] overflow-y-auto animate-fadeInUp">
        <div class="flex items-center justify-between p-6 border-b border-gray-200">
            <h3 id="dispatchModalTitle" class="text-xl font-semibold text-gray-900">Registrar Salida</h3>
            <button class="modal-close p-2 hover:bg-gray-100 rounded-lg transition-colors duration-200">
                <i class="fas fa-times text-gray-500"></i>
            </button>
        </div>

        <form id="dispatchForm" class="px-6 py-4">
            @csrf
            <input type="hidden" id="dispatchId" name="id">

            <!-- Primera fila: Medicamento -->
            <div class="mb-4">
                <label for="medicament_id" class="block text-sm font-medium text-gray-700 mb-1">Medicamento</label>
                <select id="medicament_id" name="medicament_id" required
                    class="select2-medicament w-full">
                    <option value="">Seleccionar medicamento</option>
                    @foreach($medicaments as $medicament)
                    <option value="{{ $medicament->id }}"
                        data-presentation="{{ $medicament->presentation }}"
                        data-posological="{{ $medicament->posological_units }}"
                        data-stock="{{ $medicament->stock }}">
                        {{ $medicament->name }} - {{ $medicament->presentation }} ({{ $medicament->posological_units }} unidades)
                    </option>
                    @endforeach
                </select>
                <span class="text-red-500 text-xs hidden" id="medicament_idError"></span>
            </div>

            <!-- Información del medicamento seleccionado -->
            <div class="mb-4" id="medicamentInfo" style="display: none;">
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                    <h4 class="text-sm font-medium text-blue-800 mb-2">Información del medicamento</h4>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3 text-sm">
                        <div>
                            <span class="text-blue-600 font-medium">Stock actual:</span>
                            <span id="currentStock" class="text-blue-800 font-semibold"></span>
                        </div>
                        <div>
                            <span class="text-blue-600 font-medium">Presentación:</span>
                            <span id="presentation" class="text-blue-800"></span>
                        </div>
                        <div>
                            <span class="text-blue-600 font-medium">Unidades posológicas:</span>
                            <span id="posologicalUnits" class="text-blue-800"></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Segunda fila: Cantidad y Razón -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="amount" class="block text-sm font-medium text-gray-700 mb-1">Cantidad a retirar</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center">
                            <i class="fa-solid fa-arrow-up text-gray-400"></i>
                        </div>
                        <input type="number" id="amount" name="amount" required min="1"
                            class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                        <span class="text-red-500 text-xs hidden" id="amountError"></span>
                    </div>
                </div>

                <div>
                    <label for="reason" class="block text-sm font-medium text-gray-700 mb-1">Razón de la salida</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center">
                            <i class="fas fa-clipboard-list text-gray-400"></i>
                        </div>
                        <select id="reason" name="reason" required
                            class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                            <option value="">Seleccionar razón</option>
                            <option value="Venta">Venta</option>
                            <option value="Medicamento Vencido">Medicamento Vencido</option>
                            <option value="Error de Inventario">Error de Inventario</option>
                        </select>
                        <span class="text-red-500 text-xs hidden" id="reasonError"></span>
                    </div>
                </div>
            </div>

            <!-- Botones del modal -->
            <div class="flex items-center justify-end space-x-3 pt-4 border-t border-gray-200">
                <button type="button" id="cancelBtn" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition-colors duration-200">
                    Cancelar
                </button>
                <button type="button" id="saveBtn" class="px-4 py-2 text-sm font-medium text-white bg-orange-600 border border-transparent rounded-lg hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition-colors duration-200">
                    <i class="fas fa-save mr-2"></i>
                    Registrar Salida
                </button>
            </div>
        </form>
    </div>
</div>

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

    /* Modal backdrop blur effect - CORRECCIÓN PRINCIPAL */
    #dispatchModal:not(.hidden) {
        backdrop-filter: blur(4px);
        background-color: rgba(0, 0, 0, 0.3);
        /* Cambiar de negro sólido a semi-transparente */
    }

    /* Animación de entrada del modal */
    #dispatchModal .bg-white {
        transform: scale(0.95);
        opacity: 0;
        transition: opacity 0.3s ease-in-out;
    }

    #dispatchModal:not(.hidden) .bg-white {
        transform: scale(1);
        opacity: 1;
    }

    #dispatchModal {
        transition: opacity 0.3s ease-in-out, backdrop-filter 0.3s ease-in-out;
    }

    #dispatchModal .bg-white {
        transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.3s ease-in-out;
    }

    .select2-container--default .select2-selection--single {
        height: 42px !important;
        border: 1px solid #d1d5db !important;
        border-radius: 0.5rem !important;
        padding: 0.5rem !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 26px !important;
        padding-left: 0 !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 40px !important;
    }

    .select2-dropdown {
        border-radius: 0.5rem !important;
        border: 1px solid #d1d5db !important;
    }

    .select2-container--default .select2-results__option--highlighted[aria-selected] {
        background-color: #f54a00 !important;
    }
</style>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Inicializar Select2 para medicamentos  
        $('.select2-medicament').select2({
            placeholder: 'Buscar medicamento...',
            allowClear: true,
            width: '100%',
            dropdownParent: $('#dispatchModal'),
            language: {
                noResults: function() {
                    return "No se encontraron resultados";
                },
                searching: function() {
                    return "Buscando...";
                }
            }
        });

        // Mantener valores de filtros después de la recarga  
        const urlParams = new URLSearchParams(window.location.search);

        if (urlParams.get('search')) {
            const searchValue = urlParams.get('search');
            $('#searchInput').val(searchValue);
            $('#searchInputMobile').val(searchValue);
        }

        if (urlParams.get('date_filter')) {
            const dateValue = urlParams.get('date_filter');
            $('#dateFilter').val(dateValue);
            $('#dateFilterMobile').val(dateValue);
        }

        $('#dateFilter').on('change', function() {
            const value = $(this).val();
            $('#dateFilterMobile').val(value);
            applyFilters();
        });

        $('#dateFilterMobile').on('change', function() {
            const value = $(this).val();
            $('#dateFilter').val(value);
            applyFilters();
        });

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

        // Obtener datos del medicamento al seleccionarlo  
        $('#medicament_id').on('change', function() {
            const medicamentId = $(this).val();

            if (medicamentId) {
                $.ajax({
                    url: '{{ route("medicaments.stock-data", ":id") }}'.replace(':id', medicamentId),
                    method: 'GET',
                    success: function(response) {
                        if (response.success) {
                            const medicament = response.medicament;
                            $('#currentStock').text(medicament.current_stock + ' unidades');
                            $('#presentation').text(medicament.presentation);
                            $('#posologicalUnits').text(medicament.posological_units);
                            $('#medicamentInfo').show();

                            // Establecer máximo en el input de cantidad  
                            $('#amount').attr('max', medicament.current_stock);
                        }
                    },
                    error: function() {
                        $('#medicamentInfo').hide();
                        $('#amount').removeAttr('max');
                    }
                });
            } else {
                $('#medicamentInfo').hide();
                $('#amount').removeAttr('max');
            }
        });

        // Validar cantidad en tiempo real  
        $('#amount').on('input', function() {
            const maxStock = parseInt($(this).attr('max'));
            const currentAmount = parseInt($(this).val());

            if (maxStock && currentAmount > maxStock) {
                $(this).addClass('border-red-500');
                $('#amountError').text(`Solo hay: ${maxStock} unidades disponibles`).removeClass('hidden');
            } else {
                $(this).removeClass('border-red-500');
                $('#amountError').addClass('hidden');
            }
        });

        // Abrir modal para crear  
        $(document).on('click', '#createDispatchBtn', function() {
            $('#dispatchModalTitle').text('Registrar Salida');
            $('#dispatchForm')[0].reset();
            $('#dispatchForm').attr('data-action', 'create');
            $('#dispatchId').val('');
            $('#medicamentInfo').hide();
            $('.select2-medicament').val(null).trigger('change');
            clearErrors();

            $('#dispatchModal').removeClass('hidden opacity-0').addClass('flex opacity-100');
            setTimeout(() => {
                $('#dispatchModal .bg-white').removeClass('scale-95').addClass('scale-100');
            }, 10);
        });

        // Cerrar modal  
        $('#cancelBtn, .modal-close').click(function() {
            closeModal();
        });

        function closeModal() {
            $('#dispatchModal .bg-white').css({
                'transform': 'scale(0.95)',
                'opacity': '0.8'
            });

            setTimeout(() => {
                $('#dispatchModal').css('opacity', '0');
                $('#dispatchModal .bg-white').css({
                    'transform': 'scale(0.9)',
                    'opacity': '0'
                });
            }, 100);

            setTimeout(() => {
                $('#dispatchModal').removeClass('flex opacity-100').addClass('hidden opacity-0');
                $('#dispatchModal .bg-white').css({
                    'transform': '',
                    'opacity': ''
                }).removeClass('scale-95').addClass('scale-100');
                $('#dispatchModal').css('opacity', '');
            }, 200);

            clearErrors();
        }

        // Manejar Enter para enviar el formulario  
        $('#dispatchForm').on('keypress', function(e) {
            if (e.which === 13) {
                e.preventDefault();
                $('#saveBtn').click();
            }
        });

        $('#dispatchModal').on('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });

        // Guardar salida  
        $('#saveBtn').click(function() {
            const form = $('#dispatchForm');
            const maxStock = parseInt($('#amount').attr('max'));
            const currentAmount = parseInt($('#amount').val());

            // Validar stock antes de enviar  
            if (maxStock && currentAmount > maxStock) {
                Swal.fire({
                    icon: 'error',
                    title: 'Stock insuficiente',
                    text: `No puedes retirar más de ${maxStock} unidades disponibles`
                });
                return;
            }

            $.ajax({
                url: '{{ route("dispatches.store") }}',
                method: 'POST',
                data: form.serialize(),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.success) {
                        closeModal();

                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'success',
                            title: '¡Salida registrada!',
                            text: `Salida de ${response.dispatch.amount} unidades registrada exitosamente`,
                            showConfirmButton: false,
                            timer: 1000,
                            timerProgressBar: true
                        }).then(() => {
                            window.location.reload();
                        });
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        showValidationErrors(xhr.responseJSON.errors);
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: xhr.responseJSON?.message || 'Error al procesar la solicitud'
                        });
                    }
                }
            });
        });

        // Eliminar salida  
        $(document).on('click', '.delete-dispatch', function() {
            const dispatchId = $(this).data('id');
            const medicamentName = $(this).closest('tr').find('.text-sm.font-medium').first().text();

            Swal.fire({
                title: '¿Estás seguro?',
                text: `¿Quieres eliminar la salida de "${medicamentName}"?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route("dispatches.destroy", ":id") }}'.replace(':id', dispatchId),
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
                                    text: 'La salida ha sido eliminada exitosamente',
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
                                text: 'Error al eliminar la salida'
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
            $('input, select').removeClass('border-red-500');
        }

        // Función para aplicar filtros  
        function applyFilters() {
            const search = $('#searchInput').val();
            const dateFilter = $('#dateFilter').val();
            const params = new URLSearchParams();

            if (search && search.trim() !== '') {
                params.append('search', search);
            }

            if (dateFilter && dateFilter !== 'all') {
                params.append('date_filter', dateFilter);
            }

            const url = window.location.pathname + (params.toString() ? '?' + params.toString() : '');
            window.location.href = url;
        }
    });
</script>
@endpush