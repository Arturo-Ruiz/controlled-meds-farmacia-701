@extends('layouts.app')

@section('title', 'Entradas')

@section('content')
<div class="animate-fadeInUp">
    <!-- Header -->
    <div class="bg-gradient-to-r from-green-500 via-green-600 to-emerald-600 rounded-2xl p-4 sm:p-6 lg:p-8 text-white shadow-2xl relative overflow-hidden mb-8">
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute -top-10 -right-10 w-32 h-32 bg-white/10 rounded-full blur-2xl animate-pulse"></div>
            <div class="absolute -bottom-10 -left-10 w-40 h-40 bg-white/5 rounded-full blur-3xl animate-pulse" style="animation-delay: 2s;"></div>
            <div class="absolute top-1/2 right-1/4 w-20 h-20 bg-white/5 rounded-full blur-xl animate-pulse" style="animation-delay: 4s;"></div>
        </div>

        <div class="relative z-10 flex flex-col lg:flex-row lg:items-center lg:justify-between space-y-4 lg:space-y-0">
            <div class="flex-1">
                <h1 class="text-xl sm:text-2xl lg:text-3xl font-bold mb-2">Gestión de Entradas</h1>
                <p class="text-green-100 text-sm sm:text-base lg:text-lg mb-4 lg:mb-0">Administra las entradas de medicamentos</p>
                <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-4 lg:space-x-6 space-y-2 sm:space-y-0 mt-4">
                    <div class="flex items-center space-x-2">
                        <i class="fas fa-box text-green-200"></i>
                        <span class="text-green-100 text-xs sm:text-sm">{{ $entries->total() ?? 0 }} entradas registradas</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <i class="fas fa-clock text-green-200"></i>
                        <span class="text-green-100 text-xs sm:text-sm">Actualizado {{ now()->translatedFormat('d/m/Y H:i') }}</span>
                    </div>
                </div>
            </div>
            <div class="flex items-center justify-center lg:justify-end">
                <button id="createEntryBtn" class="bg-white/20 hover:bg-white/30 text-white px-4 sm:px-6 py-2 sm:py-3 rounded-xl font-medium transition-all duration-300 hover:scale-105 backdrop-blur-sm border border-white/20 shadow-lg text-sm sm:text-base w-full sm:w-auto">
                    <i class="fas fa-plus mr-2"></i>
                    <span class="hidden sm:inline">Nueva Entrada</span>
                    <span class="sm:hidden">Nueva</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Tabla de Entradas -->
    <div class="bg-white rounded-xl shadow-lg border border-gray-100">
        <div class="p-6 border-b border-gray-200">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between space-y-4 lg:space-y-0">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Lista de Entradas</h3>
                </div>

                <!-- Filtros en desktop -->
                <div class="hidden lg:flex items-center space-x-4">
                    <div class="w-64">
                        <label class="block text-xs font-medium text-gray-700 mb-1">Buscar entrada</label>
                        <div class="relative">
                            <input type="text" id="searchInput" placeholder="Factura, laboratorio o medicamento..."
                                class="w-full pl-8 pr-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                            <div class="absolute inset-y-0 left-0 pl-2 flex items-center">
                                <i class="fas fa-search text-gray-400 text-xs"></i>
                            </div>
                        </div>
                    </div>

                    <!-- AGREGAR ESTE FILTRO DE FECHA -->
                    <div class="w-48">
                        <label class="block text-xs font-medium text-gray-700 mb-1">Filtrar por fecha</label>
                        <select id="dateFilter" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
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
                        <label class="block text-xs font-medium text-gray-700 mb-1">Buscar entrada</label>
                        <div class="relative">
                            <input type="text" id="searchInputMobile" placeholder="Factura, laboratorio o medicamento..."
                                class="w-full pl-8 pr-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                            <div class="absolute inset-y-0 left-0 pl-2 flex items-center">
                                <i class="fas fa-search text-gray-400 text-xs"></i>
                            </div>
                        </div>
                    </div>

                    <!-- AGREGAR ESTE FILTRO DE FECHA MÓVIL -->
                    <div class="w-full">
                        <label class="block text-xs font-medium text-gray-700 mb-1">Filtrar por fecha</label>
                        <select id="dateFilterMobile" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
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

        @if($entries->count() > 0)
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-receipt text-gray-400"></i>
                                <span>Factura</span>
                            </div>
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-industry text-gray-400"></i>
                                <span>Laboratorio</span>
                            </div>
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-pills text-gray-400"></i>
                                <span>Medicamento</span>
                            </div>
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-boxes text-gray-400"></i>
                                <span>Stock Ingresado</span>
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
                                <i class="fas fa-arrow-up text-gray-400"></i>
                                <span>Stock Final</span>
                            </div>
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-dollar-sign text-gray-400"></i>
                                <span>Precio</span>
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
                    @foreach($entries as $entry)
                    <tr class="hover:bg-gray-50 transition-colors duration-200">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-green-600 rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas fa-receipt text-white text-sm"></i>
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-900">{{ $entry->invoice_number }}</div>
                                    <div class="text-sm text-gray-500">ID: {{ $entry->id }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $entry->laboratory->name }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas fa-pills text-white text-sm"></i>
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-900">{{ $entry->medicament->name }}</div>
                                    <div class="text-sm text-gray-600">{{ $entry->medicament->presentation }}</div>
                                    <div class="text-xs text-gray-500 flex items-center mt-1">
                                        <i class="fas fa-capsules text-purple-500 mr-1"></i>
                                        {{ $entry->medicament->posological_units }} unidades posológicas
                                    </div>
                                </div>
                            </div>
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex flex-col space-y-2">
                                <!-- Stock en unidades (actual) -->
                                <div class="flex items-center px-2 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">
                                    <i class="fas fa-plus mr-1"></i>
                                    {{ number_format($entry->stock) }} unidades
                                </div>

                                <!-- Unidades posológicas ingresadas -->
                                <div class="flex items-center px-2 py-1 bg-purple-100 text-purple-800 text-xs font-medium rounded-full">
                                    <i class="fas fa-capsules mr-1"></i>
                                    {{ number_format($entry->stock * $entry->medicament->posological_units) }} u. posológicas
                                </div>
                            </div>
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex flex-col space-y-2">
                                <div class="flex items-center space-x-2">
                                    <span class="px-3 py-1 bg-gray-100 text-gray-700 text-sm font-medium rounded-full flex items-center">
                                        <i class="fas fa-history mr-1"></i>
                                        {{ $entry->current_stock }} unidades
                                    </span>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <span class="px-3 py-1 bg-purple-100 text-purple-700 text-xs font-medium rounded-full flex items-center">
                                        <i class="fas fa-pills mr-1"></i>
                                        {{ $entry->current_stock * $entry->medicament->posological_units }} u. posológicas
                                    </span>
                                </div>
                            </div>
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex flex-col space-y-2">
                                <div class="flex items-center space-x-2">
                                    <span class="px-3 py-1 bg-blue-100 text-blue-700 text-sm font-medium rounded-full flex items-center">
                                        <i class="fas fa-arrow-up mr-1"></i>
                                        {{ $entry->final_stock }} unidades
                                    </span>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <span class="px-3 py-1 bg-purple-100 text-purple-700 text-xs font-medium rounded-full flex items-center">
                                        <i class="fas fa-pills mr-1"></i>
                                        {{ $entry->final_stock * $entry->medicament->posological_units }} u. posológicas
                                    </span>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-green-600">${{ number_format($entry->price, 2) }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $entry->created_at->format('d/m/Y') }}</div>
                            <div class="text-sm text-gray-500">{{ $entry->created_at->format('H:i') }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <div class="flex items-center justify-center space-x-2">
                                <button class="delete-entry p-2 text-red-600 hover:text-red-700 hover:bg-red-50 rounded-lg transition-all duration-200"
                                    data-id="{{ $entry->id }}"
                                    title="Eliminar entrada">
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
                <i class="fas fa-box text-gray-400 text-3xl"></i>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mb-2">No hay entradas registradas</h3>
            <p class="text-gray-500 mb-6">Comienza agregando tu primera entrada</p>
            <button id="createEntryBtn" class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-xl font-medium transition-colors duration-200">
                <i class="fas fa-plus mr-2"></i>
                Agregar Entrada
            </button>
        </div>
        @endif

        <!-- Paginación -->
        @if($entries->hasPages())
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $entries->links() }}
        </div>
        @endif
    </div>
</div>

<!-- Modal -->
<div id="entryModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center transition-opacity duration-300 opacity-0">
    <div class="bg-white rounded-2xl shadow-2xl max-w-2xl w-full mx-4 max-h-[90vh] overflow-y-auto animate-fadeInUp">
        <div class="flex items-center justify-between p-6 border-b border-gray-200">
            <h3 id="entryModalTitle" class="text-xl font-semibold text-gray-900">Crear Entrada</h3>
            <button class="modal-close p-2 hover:bg-gray-100 rounded-lg transition-colors duration-200">
                <i class="fas fa-times text-gray-500"></i>
            </button>
        </div>

        <form id="entryForm" class="px-6 py-4">
            @csrf
            <input type="hidden" id="entryId" name="id">

            <!-- Número de factura y Laboratorio -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-2">
                <div class="mb-4">
                    <label for="invoice_number" class="block text-sm font-medium text-gray-700 mb-1">Número de factura</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-receipt text-gray-400"></i>
                        </div>
                        <input type="text" id="invoice_number" name="invoice_number" required
                            class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                        <span class="text-red-500 text-xs hidden" id="invoice_numberError"></span>
                    </div>
                </div>
                <div>
                    <label for="laboratory_id" class="block text-sm font-medium text-gray-700 mb-1">Laboratorio</label>
                    <div class="relative">
                        <select id="laboratory_id" name="laboratory_id" required
                            class="select2-laboratory w-full pl-10">
                            <option value="">Seleccionar laboratorio</option>
                            @foreach($laboratories as $laboratory)
                            <option value="{{ $laboratory->id }}">{{ $laboratory->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <span class="text-red-500 text-xs hidden" id="laboratory_idError"></span>
                </div>
            </div>

            <!-- Contenedor de medicamentos -->
            <div class="mb-4">
                <div id="medicamentsContainer" class="space-y-3">
                </div>

                <div class="flex justify-end items-center mt-5 mb-2">
                    <button type="button" id="addMedicamentBtn" class="text-green-600 hover:text-green-700 text-sm font-medium cursor-pointer">
                        <i class="fas fa-plus mr-1"></i>Agregar medicamento
                    </button>
                </div>
            </div>
        </form>

        <div class="px-6 py-4 border-t border-gray-200 flex justify-end space-x-3">
            <button id="cancelBtn" class="px-4 py-2 text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg transition-colors duration-200">
                Cancelar
            </button>
            <button id="saveBtn" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg transition-colors duration-200">
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

    #entryModal:not(.hidden) {
        backdrop-filter: blur(4px);
        background-color: rgba(0, 0, 0, 0.3);
        /* Cambiar de negro sólido a semi-transparente */
    }

    /* Animación de entrada del modal */
    #entryModal .bg-white {
        transform: scale(0.95);
        opacity: 0;
        transition: opacity 0.3s ease-in-out;
    }

    #entryModal:not(.hidden) .bg-white {
        transform: scale(1);
        opacity: 1;
    }

    #entryModal {
        transition: opacity 0.3s ease-in-out, backdrop-filter 0.3s ease-in-out;
    }

    #entryModal .bg-white {
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
        background-color: #10b981 !important;
    }
</style>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        const urlParams = new URLSearchParams(window.location.search);
        let medicamentRowIndex = 0;

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

        $('.select2-medicament').on('change', function() {
            const medicamentId = $(this).val();

            if (medicamentId) {
                $.ajax({
                    url: '{{ route("medicaments.data", ":id") }}'.replace(':id', medicamentId),
                    method: 'GET',
                    success: function(response) {
                        if (response.success) {
                            const medicament = response.medicament;
                            $('#current_stock').val(medicament.current_stock + ' unidades');
                            $('#current_price').val('$' + parseFloat(medicament.current_price).toFixed(2));
                            $('#currentMedicamentInfo').show();
                        }
                    },
                    error: function() {
                        $('#currentMedicamentInfo').hide();
                    }
                });
            } else {
                $('#currentMedicamentInfo').hide();
            }
        });

        $('.select2-laboratory').select2({
            placeholder: 'Buscar laboratorio...',
            allowClear: true,
            width: '100%',
            dropdownParent: $('#entryModal'),
            language: {
                noResults: function() {
                    return "No se encontraron resultados";
                },
                searching: function() {
                    return "Buscando...";
                }
            }
        });

        $('.select2-medicament').select2({
            placeholder: 'Buscar medicamento...',
            allowClear: true,
            width: '100%',
            dropdownParent: $('#entryModal'),
            language: {
                noResults: function() {
                    return "No se encontraron resultados";
                },
                searching: function() {
                    return "Buscando...";
                }
            }
        });

        $(document).on('click', '.remove-medicament-btn', function() {
            if ($('.medicament-row').length > 1) {
                $(this).closest('.medicament-row').remove();
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: 'Atención',
                    text: 'Debe haber al menos un medicamento'
                });
            }
        });

        $('#addMedicamentBtn').click(function() {
            addMedicamentRow();
        });

        // Abrir modal para crear  
        $(document).on('click', '#createEntryBtn', function() {
            $('#entryModalTitle').text('Nueva Entrada');
            $('#entryForm')[0].reset();
            $('#medicamentsContainer').empty();
            medicamentRowIndex = 0;
            addMedicamentRow(); // Agregar primera fila  

            $('#entryModal').removeClass('hidden opacity-0').addClass('flex opacity-100');
        });

        // Cerrar modal  
        $('#cancelBtn, .modal-close').click(function() {
            closeModal();
        });

        function closeModal() {
            $('#entryModal .bg-white').css({
                'transform': 'scale(0.95)',
                'opacity': '0.8'
            });

            setTimeout(() => {
                $('#entryModal').css('opacity', '0');
                $('#entryModal .bg-white').css({
                    'transform': 'scale(0.9)',
                    'opacity': '0'
                });
            }, 100);

            setTimeout(() => {
                $('#entryModal').removeClass('flex opacity-100').addClass('hidden opacity-0');
                $('#entryModal .bg-white').css({
                    'transform': '',
                    'opacity': ''
                }).removeClass('scale-95').addClass('scale-100');
                $('#entryModal').css('opacity', '');
            }, 200);

            clearErrors();
        }

        function addMedicamentRow() {
            const row = `    
<div class="medicament-row border border-gray-200 rounded-lg p-4 bg-white shadow-sm" data-index="${medicamentRowIndex}">    
    <div class="grid grid-cols-1 md:grid-cols-12 gap-3">    
        <!-- Medicamento - ocupa 6 columnas (50%) -->  

        <div class="md:col-span-6">    
            <label class="block text-sm font-medium text-gray-700 mb-1">Medicamento #${medicamentRowIndex + 1}</label>    
            <select name="medicaments[${medicamentRowIndex}][medicament_id]" required     
                    class="select2-medicament-row w-full"  
                    data-row-index="${medicamentRowIndex}">    
                <option value="">Seleccionar medicamento</option>    
                @foreach($medicaments as $medicament)    
                <option value="{{ $medicament->id }}">    
                    {{ $medicament->name }} - {{ $medicament->presentation }}    
                </option>    
                @endforeach    
            </select>  
              
            <!-- Current stock, price and posological units info - MEJORADO -->  
            <div class="current-medicament-info mt-2 hidden" id="currentInfo_${medicamentRowIndex}">  
                <div class="flex gap-1.5 text-xs items-center flex-nowrap">  
                    <div class="bg-blue-50 px-2 py-1 rounded flex items-center gap-1 border border-blue-200 whitespace-nowrap">  
                        <i class="fas fa-boxes text-blue-600 text-xs"></i>  
                        <span class="font-semibold text-blue-700 current-stock-display"></span>  
                    </div>  
                    <div class="bg-green-50 px-2 py-1 rounded flex items-center gap-1 border border-green-200 whitespace-nowrap">  
                        <span class="font-semibold text-green-700 current-price-display"></span>  
                    </div>  
                    <div class="bg-purple-50 px-2 py-1 rounded flex items-center gap-1 border border-purple-200 whitespace-nowrap">  
                        <i class="fas fa-capsules text-purple-600 text-xs"></i>  
                        <span class="font-semibold text-purple-700 posological-units-display"></span>  
                    </div>  
                </div>  
            </div>  
        </div>    
            
        <!-- Stock - ocupa 2 columnas (~17%) -->  
        <div class="md:col-span-2">    
            <label class="block text-sm font-medium text-gray-700 mb-1">Stock</label>    
            <div class="relative">  
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">  
                    <i class="fas fa-boxes text-gray-400 text-sm"></i>  
                </div>  
                <input type="number" name="medicaments[${medicamentRowIndex}][stock]"     
                       required min="1"   
                       class="w-full pl-9 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all">    
            </div>  
        </div>    
            
        <!-- Precio - ocupa 3 columnas (25%) -->  
        <div class="md:col-span-3">    
            <label class="block text-sm font-medium text-gray-700 mb-1">Precio</label>    
            <div class="relative">  
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">  
                    <i class="fas fa-dollar-sign text-gray-400 text-sm"></i>  
                </div>  
                <input type="number" name="medicaments[${medicamentRowIndex}][price]"     
                       required min="0" step="0.01"   
                       class="w-full pl-9 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all">    
            </div>  
        </div>  
          
        <!-- Botón eliminar - ocupa 1 columna (~8%) -->  
        <div class="md:col-span-1 flex items-start pt-6">  
            <button type="button" class="remove-medicament-btn cursor-pointer w-full h-[42px] text-red-600 hover:text-white hover:bg-red-600 border border-red-300 hover:border-red-600 rounded-lg transition-all duration-200 flex items-center justify-center">    
                <i class="fas fa-trash text-sm"></i>    
            </button>    
        </div>  
    </div>    
</div>    
`;

            $('#medicamentsContainer').append(row);

            // Initialize Select2 for the newly added row  
            const $select = $(`.medicament-row[data-index="${medicamentRowIndex}"] .select2-medicament-row`);
            $select.select2({
                placeholder: 'Buscar medicamento...',
                allowClear: true,
                width: '100%',
                dropdownParent: $('#entryModal')
            });

            medicamentRowIndex++;
        }

        $(document).on('change', '.select2-medicament-row', function() {
            const medicamentId = $(this).val();
            const rowIndex = $(this).data('row-index');
            const $infoContainer = $(`#currentInfo_${rowIndex}`);

            if (medicamentId) {
                $.ajax({
                    url: '{{ route("medicaments.data", ":id") }}'.replace(':id', medicamentId),
                    method: 'GET',
                    success: function(response) {
                        if (response.success) {
                            const medicament = response.medicament;

                            // Mostrar stock actual  
                            $infoContainer.find('.current-stock-display').text(medicament.current_stock + ' unidades');

                            // Mostrar precio actual  
                            $infoContainer.find('.current-price-display').text('$' + parseFloat(medicament.current_price).toFixed(2));

                            // Mostrar unidades posológicas por unidad  
                            $infoContainer.find('.posological-units-display').text(medicament.posological_units + ' Unidades Posológicas ');

                            $infoContainer.removeClass('hidden');
                        }
                    },
                    error: function() {
                        $infoContainer.addClass('hidden');
                    }
                });
            } else {
                $infoContainer.addClass('hidden');
            }
        });

        // Helper function para formatear números  
        function number_format(number) {
            return new Intl.NumberFormat('es-ES').format(number);
        }


        // Manejar Enter para enviar el formulario  
        $('#entryForm').on('keypress', function(e) {
            if (e.which === 13) {
                e.preventDefault();
                $('#saveBtn').click();
            }
        });

        $('#entryModal').on('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });


        // Guardar entrada  
        $('#saveBtn').click(function() {
            const formData = $('#entryForm').serialize();

            $.ajax({
                url: '{{ route("entries.store") }}',
                method: 'POST',
                data: formData,
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
                            title: '¡Entradas creadas!',
                            text: `${response.entries.length} medicamento(s) registrados`,
                            showConfirmButton: false,
                            timer: 1500,
                            timerProgressBar: true
                        }).then(() => {
                            window.location.reload();
                        });
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        showValidationErrors(xhr.responseJSON.errors);
                    }
                }
            });
        });


        // Eliminar entrada  
        $(document).on('click', '.delete-entry', function() {
            const entryId = $(this).data('id');

            const entryInvoice = $(this).closest('tr').find('.text-sm.font-medium').first().text();

            Swal.fire({
                title: '¿Estás seguro?',
                text: `¿Quieres eliminar la entrada "${entryInvoice}"?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route("entries.destroy", ":id") }}'.replace(':id', entryId),
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
                                    text: 'La entrada ha sido eliminada exitosamente',
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
                                text: 'Error al eliminar la entrada'
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