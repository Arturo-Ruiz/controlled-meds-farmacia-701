@extends('layouts.app')

@section('title', 'Medicamentos')

@section('content')
<div class="space-y-6">
    <!-- Header con botón para crear -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Gestión de Medicamentos</h1>
            <p class="text-gray-600">Administra el inventario de medicamentos de la farmacia</p>
        </div>
        <button id="createMedicamentBtn"
            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium transition-colors duration-200 flex items-center">
            <i class="fas fa-plus mr-2"></i>
            Nuevo Medicamento
        </button>
    </div>

    <!-- Filtros y búsqueda -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Buscar medicamento</label>
                <input type="text" id="searchInput" placeholder="Nombre o presentación..."
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Estado de stock</label>
                <select id="stockFilter" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Todos</option>
                    <option value="low">Stock bajo</option>
                    <option value="normal">Stock normal</option>
                    <option value="expired">Próximos a vencer</option>
                </select>
            </div>
            <div class="flex items-end">
                <button id="clearFilters" class="w-full bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg transition-colors duration-200">
                    Limpiar filtros
                </button>
            </div>
        </div>
    </div>

    <!-- Tabla de medicamentos -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Medicamento</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stock</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Precio</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Vencimiento</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody id="medicamentsTableBody" class="bg-white divide-y divide-gray-200">
                    @foreach($medicaments as $medicament)
                    <tr class="hover:bg-gray-50 transition-colors duration-200">
                        <td class="px-6 py-4">
                            <div>
                                <div class="text-sm font-medium text-gray-900">{{ $medicament->name }}</div>
                                <div class="text-sm text-gray-500">{{ $medicament->presentation }}</div>
                                <div class="text-xs text-gray-400">{{ $medicament->posological_units }} unidades posológicas</div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900">{{ $medicament->stock }} unidades</div>
                            <div class="text-xs text-gray-500">Mín: {{ $medicament->min_stock }}</div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-900">
                            ${{ number_format($medicament->price, 2) }}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-900">
                            {{ $medicament->expiration_date->format('d/m/Y') }}
                        </td>
                        <td class="px-6 py-4">
                            @if($medicament->is_low_stock)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                Stock bajo
                            </span>
                            @elseif($medicament->expiration_date->diffInDays(now()) <= 30)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                Próximo a vencer
                                </span>
                                @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    Normal
                                </span>
                                @endif
                        </td>
                        <td class="px-6 py-4 text-right text-sm font-medium space-x-2">
                            <button class="text-blue-600 hover:text-blue-900 edit-btn" data-id="{{ $medicament->id }}">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="text-red-600 hover:text-red-900 delete-btn" data-id="{{ $medicament->id }}">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Paginación -->
        <div class="px-6 py-3 border-t border-gray-200">
            {{ $medicaments->links() }}
        </div>
    </div>
</div>

<!-- Modal para crear/editar medicamento -->
<div id="medicamentModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 id="modalTitle" class="text-lg font-medium text-gray-900">Nuevo Medicamento</h3>
        </div>

        <form id="medicamentForm" class="px-6 py-4 space-y-4">
            @csrf
            <input type="hidden" id="medicamentId" name="id">

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nombre del medicamento</label>
                <input type="text" id="name" name="name" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <span class="text-red-500 text-xs hidden" id="nameError"></span>
            </div>

            <div>
                <label for="presentation" class="block text-sm font-medium text-gray-700 mb-1">Presentación</label>
                <input type="text" id="presentation" name="presentation" required
                    placeholder="Ej: Tabletas, Jarabe, Cápsulas"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <span class="text-red-500 text-xs hidden" id="presentationError"></span>
            </div>

            <div>
                <label for="posological_units" class="block text-sm font-medium text-gray-700 mb-1">Unidades posológicas</label>
                <input type="number" id="posological_units" name="posological_units" required min="1"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <span class="text-red-500 text-xs hidden" id="posological_unitsError"></span>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="stock" class="block text-sm font-medium text-gray-700 mb-1">Stock actual</label>
                    <input type="number" id="stock" name="stock" required min="0"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <span class="text-red-500 text-xs hidden" id="stockError"></span>
                </div>

                <div>
                    <label for="min_stock" class="block text-sm font-medium text-gray-700 mb-1">Stock mínimo</label>
                    <input type="number" id="min_stock" name="min_stock" required min="0"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <span class="text-red-500 text-xs hidden" id="min_stockError"></span>
                </div>
            </div>

            <div>
                <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Precio</label>
                <input type="number" id="price" name="price" required min="0" step="0.01"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <span class="text-red-500 text-xs hidden" id="priceError"></span>
            </div>

            <div>
                <label for="expiration_date" class="block text-sm font-medium text-gray-700 mb-1">Fecha de vencimiento</label>
                <input type="date" id="expiration_date" name="expiration_date" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <span class="text-red-500 text-xs hidden" id="expiration_dateError"></span>
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
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Abrir modal para crear  
        $('#createMedicamentBtn').click(function() {
            $('#medicamentModalTitle').text('Crear Medicamento');
            $('#medicamentForm')[0].reset();
            $('#medicamentForm').attr('data-action', 'create');
            $('#medicamentModal').removeClass('hidden').addClass('flex');
        });

        // Cerrar modal  
        $('#cancelBtn, .modal-close').click(function() {
            $('#medicamentModal').addClass('hidden').removeClass('flex');
            clearErrors();
        });

        // Guardar medicamento  
        $('#saveBtn').click(function() {
            const form = $('#medicamentForm');
            const action = form.attr('data-action');
            const medicamentId = form.attr('data-id');

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
                        $('#medicamentModal').addClass('hidden').removeClass('flex');
                        location.reload(); // Recargar la página para mostrar cambios  

                        // Mostrar mensaje de éxito  
                        showAlert('success', response.message);
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        const errors = xhr.responseJSON.errors;
                        showValidationErrors(errors);
                    } else {
                        showAlert('error', 'Error al procesar la solicitud');
                    }
                }
            });
        });

        // Editar medicamento  
        $('.edit-btn').click(function() {
            const medicamentId = $(this).data('id');

            $.ajax({
                url: '{{ route("medicaments.show", ":id") }}'.replace(':id', medicamentId),
                method: 'GET',
                success: function(response) {
                    if (response.success) {
                        const medicament = response.medicament;

                        $('#medicamentModalTitle').text('Editar Medicamento');
                        $('#name').val(medicament.name);
                        $('#presentation').val(medicament.presentation);
                        $('#posological_units').val(medicament.posological_units);
                        $('#stock').val(medicament.stock);
                        $('#min_stock').val(medicament.min_stock);
                        $('#price').val(medicament.price);
                        $('#expiration_date').val(medicament.expiration_date);

                        $('#medicamentForm').attr('data-action', 'edit');
                        $('#medicamentForm').attr('data-id', medicamentId);
                        $('#medicamentModal').removeClass('hidden').addClass('flex');
                    }
                }
            });
        });

        // Eliminar medicamento  
        $('.delete-btn').click(function() {
            const medicamentId = $(this).data('id');

            if (confirm('¿Estás seguro de que quieres eliminar este medicamento?')) {
                $.ajax({
                    url: '{{ route("medicaments.destroy", ":id") }}'.replace(':id', medicamentId),
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {
                            location.reload();
                            showAlert('success', response.message);
                        }
                    },
                    error: function() {
                        showAlert('error', 'Error al eliminar el medicamento');
                    }
                });
            }
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

        function showAlert(type, message) {
            const alertClass = type === 'success' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800';
            const alert = `  
            <div class="fixed top-4 right-4 z-50 p-4 rounded-lg ${alertClass} shadow-lg">  
                ${message}  
            </div>  
        `;

            $('body').append(alert);

            setTimeout(function() {
                $('.fixed.top-4.right-4').fadeOut();
            }, 3000);
        }
    });
</script>
@endpush