@extends('layouts.app')

@section('title', 'Reportes')

@section('content')
<div class="animate-fadeInUp">
    <!-- Header con gradiente animado -->
    <div class="bg-gradient-to-r from-cyan-500 via-cyan-600 to-blue-600 rounded-2xl p-4 sm:p-6 lg:p-8 text-white shadow-2xl relative overflow-hidden mb-8">
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute -top-10 -right-10 w-32 h-32 bg-white/10 rounded-full blur-2xl animate-pulse"></div>
            <div class="absolute -bottom-10 -left-10 w-40 h-40 bg-white/5 rounded-full blur-3xl animate-pulse" style="animation-delay: 2s;"></div>
            <div class="absolute top-1/2 right-1/4 w-20 h-20 bg-white/5 rounded-full blur-xl animate-pulse" style="animation-delay: 4s;"></div>
        </div>

        <div class="relative z-10 flex flex-col lg:flex-row lg:items-center lg:justify-between space-y-4 lg:space-y-0">
            <div class="flex-1">
                <h1 class="text-xl sm:text-2xl lg:text-3xl font-bold mb-2">Gestión de Reportes</h1>
                <p class="text-cyan-100 text-sm sm:text-base lg:text-lg mb-4 lg:mb-0">Genera reportes mensuales de movimiento de medicamentos</p>
                <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-4 lg:space-x-6 space-y-2 sm:space-y-0 mt-4">
                    <div class="flex items-center space-x-2">
                        <i class="fas fa-file-pdf text-cyan-200"></i>
                        <span class="text-cyan-100 text-xs sm:text-sm">Reportes en PDF</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <i class="fas fa-clock text-cyan-200"></i>
                        <span class="text-cyan-100 text-xs sm:text-sm">Actualizado {{ now()->translatedFormat('d/m/Y H:i') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Formulario de Generación de Reportes -->
    <div class="bg-white rounded-xl shadow-lg border border-gray-100">
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Generar Reporte Mensual</h3>
            <p class="text-sm text-gray-600 mt-1">Selecciona el mes, año y tipo de medicamento para generar el reporte</p>
        </div>

        <div class="p-6">
            <form id="reportForm" method="POST" action="{{ route('reports.monthly') }}">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Mes -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-calendar-alt text-cyan-500 mr-2"></i>
                            Mes
                        </label>
                        <select name="month" id="month" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 transition-all duration-200">
                            <option value="">Seleccione un mes</option>
                            <option value="1">Enero</option>
                            <option value="2">Febrero</option>
                            <option value="3">Marzo</option>
                            <option value="4">Abril</option>
                            <option value="5">Mayo</option>
                            <option value="6">Junio</option>
                            <option value="7">Julio</option>
                            <option value="8">Agosto</option>
                            <option value="9">Septiembre</option>
                            <option value="10">Octubre</option>
                            <option value="11">Noviembre</option>
                            <option value="12">Diciembre</option>
                        </select>
                    </div>

                    <!-- Año -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-calendar text-cyan-500 mr-2"></i>
                            Año
                        </label>
                        <input type="number" name="year" id="year" required
                            min="2020" max="2100" value="{{ date('Y') }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 transition-all duration-200">
                    </div>

                    <!-- Tipo de Medicamento -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-tags text-cyan-500 mr-2"></i>
                            Tipo de Medicamento
                        </label>
                        <select name="medicament_type_id" id="medicament_type_id" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 transition-all duration-200">
                            <option value="">Seleccione un tipo</option>
                            @foreach($medicamentTypes as $type)
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Botón de Generación -->
                <div class="mt-6 flex justify-end">
                    <button type="submit"
                        class="bg-gradient-to-r from-cyan-600 to-blue-600 text-white font-semibold py-3 px-8 rounded-lg hover:from-cyan-700 hover:to-blue-700 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl flex items-center space-x-2">
                        <i class="fas fa-file-pdf"></i>
                        <span>Generar Reporte PDF</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Información Adicional -->
    <div class="mt-8 bg-gradient-to-r from-cyan-50 to-blue-50 rounded-xl p-6 border border-cyan-100">
        <div class="flex items-start space-x-4">
            <div class="flex-shrink-0">
                <div class="w-12 h-12 bg-gradient-to-br from-cyan-500 to-blue-600 rounded-xl flex items-center justify-center">
                    <i class="fas fa-info-circle text-white text-xl"></i>
                </div>
            </div>
            <div class="flex-1">
                <h4 class="text-lg font-semibold text-gray-900 mb-2">Información del Reporte</h4>
                <ul class="space-y-2 text-sm text-gray-700">
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-cyan-500 mr-2 mt-1"></i>
                        <span>El reporte agrupa los medicamentos por <strong>principio activo</strong></span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-cyan-500 mr-2 mt-1"></i>
                        <span>Muestra las <strong>entradas y salidas</strong> en unidades posológicas del mes seleccionado</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-cyan-500 mr-2 mt-1"></i>
                        <span>Incluye la <strong>existencia anterior</strong> (fin del mes anterior) y <strong>existencia actual</strong> (fin del mes seleccionado)</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-cyan-500 mr-2 mt-1"></i>
                        <span>Lista todas las <strong>droguerías</strong> y <strong>números de factura</strong> asociados</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection