@extends('layouts.app')

@section('title', 'Panel de control')

@section('content')
<div class="space-y-8 animate-fadeInUp">
    <!-- Cards de Estadísticas Mejoradas -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Medicamentos -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 mb-1">Total Medicamentos</p>
                    <p class="text-3xl font-bold text-gray-900 stat-number">1,247</p>
                    <p class="text-sm text-green-600 flex items-center mt-2">
                        <i class="fas fa-arrow-up mr-1"></i>
                        +12% vs mes anterior
                    </p>
                </div>
                <div class="p-4 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl">
                    <i class="fas fa-pills text-white text-2xl"></i>
                </div>
            </div>
        </div>

        <!-- Entradas -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 mb-1">Entradas del Mes</p>
                    <p class="text-3xl font-bold text-gray-900 stat-number">156</p>
                    <p class="text-sm text-green-600 flex items-center mt-2">
                        <i class="fas fa-arrow-up mr-1"></i>
                        +8% vs mes anterior
                    </p>
                </div>
                <div class="p-4 bg-gradient-to-br from-green-500 to-green-600 rounded-xl">
                    <i class="fas fa-arrow-down text-white text-2xl"></i>
                </div>
            </div>
        </div>

        <!-- Salidas -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 mb-1">Salidas del Mes</p>
                    <p class="text-3xl font-bold text-gray-900 stat-number">89</p>
                    <p class="text-sm text-orange-600 flex items-center mt-2">
                        <i class="fas fa-arrow-up mr-1"></i>
                        +5% vs mes anterior
                    </p>
                </div>
                <div class="p-4 bg-gradient-to-br from-orange-500 to-orange-600 rounded-xl">
                    <i class="fas fa-arrow-up text-white text-2xl"></i>
                </div>
            </div>
        </div>

        <!-- Stock Bajo -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 mb-1">Stock Bajo</p>
                    <p class="text-3xl font-bold text-gray-900 stat-number">23</p>
                    <p class="text-sm text-red-600 flex items-center mt-2">
                        <i class="fas fa-exclamation-triangle mr-1"></i>
                        Requiere atención
                    </p>
                </div>
                <div class="p-4 bg-gradient-to-br from-red-500 to-red-600 rounded-xl">
                    <i class="fas fa-exclamation-triangle text-white text-2xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Alertas de Stock Bajo -->
    <div class="bg-gradient-to-r from-red-50 to-orange-50 border border-red-200 rounded-2xl p-6 shadow-lg">
        <div class="flex items-center mb-4">
            <div class="p-2 bg-red-100 rounded-lg mr-3">
                <i class="fas fa-exclamation-triangle text-red-600 text-xl"></i>
            </div>
            <h3 class="text-lg font-semibold text-red-800">Alertas de Stock Bajo</h3>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <div class="bg-white rounded-xl p-4 border border-red-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="font-medium text-gray-900">Paracetamol 500mg</p>
                        <p class="text-sm text-gray-600">Stock actual: 5 unidades</p>
                    </div>
                    <span class="px-2 py-1 bg-red-100 text-red-800 text-xs font-medium rounded-full">Crítico</span>
                </div>
            </div>
            <div class="bg-white rounded-xl p-4 border border-orange-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="font-medium text-gray-900">Ibuprofeno 400mg</p>
                        <p class="text-sm text-gray-600">Stock actual: 12 unidades</p>
                    </div>
                    <span class="px-2 py-1 bg-orange-100 text-orange-800 text-xs font-medium rounded-full">Bajo</span>
                </div>
            </div>
            <div class="bg-white rounded-xl p-4 border border-yellow-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="font-medium text-gray-900">Amoxicilina 250mg</p>
                        <p class="text-sm text-gray-600">Stock actual: 18 unidades</p>
                    </div>
                    <span class="px-2 py-1 bg-yellow-100 text-yellow-800 text-xs font-medium rounded-full">Medio</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Accesos Rápidos -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-6 flex items-center">
            <i class="fas fa-bolt text-blue-600 mr-3"></i>
            Accesos Rápidos
        </h3>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <button class="p-4 bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl hover:from-blue-100 hover:to-blue-200 transition-all duration-300 group">
                <div class="text-center">
                    <i class="fas fa-plus-circle text-blue-600 text-2xl mb-2 group-hover:scale-110 transition-transform"></i>
                    <p class="text-sm font-medium text-blue-800">Nuevo Medicamento</p>
                </div>
            </button>
            <button class="p-4 bg-gradient-to-br from-green-50 to-green-100 rounded-xl hover:from-green-100 hover:to-green-200 transition-all duration-300 group">
                <div class="text-center">
                    <i class="fas fa-arrow-down text-green-600 text-2xl mb-2 group-hover:scale-110 transition-transform"></i>
                    <p class="text-sm font-medium text-green-800">Registrar Entrada</p>
                </div>
            </button>
            <button class="p-4 bg-gradient-to-br from-orange-50 to-orange-100 rounded-xl hover:from-orange-100 hover:to-orange-200 transition-all duration-300 group">
                <div class="text-center">
                    <i class="fas fa-arrow-up text-orange-600 text-2xl mb-2 group-hover:scale-110 transition-transform"></i>
                    <p class="text-sm font-medium text-orange-800">Registrar Salida</p>
                </div>
            </button>
            <button class="p-4 bg-gradient-to-br from-purple-50 to-purple-100 rounded-xl hover:from-purple-100 hover:to-purple-200 transition-all duration-300 group">
                <div class="text-center">
                    <i class="fas fa-chart-bar text-purple-600 text-2xl mb-2 group-hover:scale-110 transition-transform"></i>
                    <p class="text-sm font-medium text-purple-800">Ver Reportes</p>
                </div>
            </button>
        </div>
    </div>

    <!-- Sección de Entradas y Salidas Recientes -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Entradas Recientes -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-100 bg-gradient-to-r from-green-50 to-green-100">
                <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                    <i class="fas fa-arrow-down text-green-600 mr-3"></i>
                    Entradas Recientes
                </h3>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors duration-200">
                        <div class="flex items-center">
                            <div class="p-2 bg-green-100 rounded-lg mr-4">
                                <i class="fas fa-pills text-green-600"></i>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900">Paracetamol - 500 mg</p>
                                <p class="text-sm text-gray-600">100 unidades → Proveedor ABC</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="font-semibold text-green-600">+100 unidades</p>
                            <p class="text-sm text-gray-500">Hoy, 10:30</p>
                        </div>
                    </div>

                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors duration-200">
                        <div class="flex items-center">
                            <div class="p-2 bg-green-100 rounded-lg mr-4">
                                <i class="fas fa-capsules text-green-600"></i>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900">Ibuprofeno - 400 mg</p>
                                <p class="text-sm text-gray-600">50 unidades → Proveedor XYZ</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="font-semibold text-green-600">+50 unidades</p>
                            <p class="text-sm text-gray-500">Ayer, 16:45</p>
                        </div>
                    </div>
                </div>
                <div class="mt-4 text-center">
                    <button class="text-green-600 hover:text-green-700 font-medium text-sm">
                        Ver todas las entradas →
                    </button>
                </div>
            </div>
        </div>
        <!-- Salidas Recientes -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-100 bg-gradient-to-r from-orange-50 to-orange-100">
                <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                    <i class="fas fa-arrow-down text-orange-600 mr-3"></i>
                    Salidas Recientes
                </h3>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors duration-200">
                        <div class="flex items-center">
                            <div class="p-2 bg-orange-100 rounded-lg mr-4">
                                <i class="fas fa-prescription-bottle text-orange-600"></i>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900">Paracetamol - 500 mg</p>
                                <p class="text-sm text-gray-600">20 unidades → Paciente XYZ</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="font-semibold text-orange-600">-20 unidades</p>
                            <p class="text-sm text-gray-500">Hoy, 14:30</p>
                        </div>
                    </div>

                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors duration-200">
                        <div class="flex items-center">
                            <div class="p-2 bg-orange-100 rounded-lg mr-4">
                                <i class="fas fa-capsules text-orange-600"></i>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900">Ibuprofeno - 400 mg</p>
                                <p class="text-sm text-gray-600">15 unidades → Paciente ABC</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="font-semibold text-orange-600">-15 unidades</p>
                            <p class="text-sm text-gray-500">Ayer, 16:45</p>
                        </div>
                    </div>
                </div>
                <div class="mt-4 text-center">
                    <button class="text-orange-600 hover:text-orange-700 font-medium text-sm">
                        Ver todas las salidas →
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Gráficos Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Gráfico de Movimientos -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-6 flex items-center">
                <i class="fas fa-chart-line text-blue-600 mr-3"></i>
                Movimientos del Mes
            </h3>
            <div class="h-64">
                <canvas id="movimientosChart"></canvas>
            </div>
        </div>

        <!-- Gráfico de Distribución de Stock -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-6 flex items-center">
                <i class="fas fa-chart-pie text-purple-600 mr-3"></i>
                Distribución de Stock
            </h3>
            <div class="h-64">
                <canvas id="stockChart"></canvas>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Contadores animados  
        $('.stat-number').each(function() {
            const $this = $(this);
            const countTo = parseInt($this.text());

            $({
                countNum: 0
            }).animate({
                countNum: countTo
            }, {
                duration: 2000,
                easing: 'swing',
                step: function() {
                    $this.text(Math.floor(this.countNum));
                },
                complete: function() {
                    $this.text(this.countNum);
                }
            });
        });

        // Gráfico de Movimientos (Líneas)  
        const ctx1 = document.getElementById('movimientosChart').getContext('2d');
        new Chart(ctx1, {
            type: 'line',
            data: {
                labels: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun'],
                datasets: [{
                    label: 'Entradas',
                    data: [120, 190, 300, 500, 200, 300],
                    borderColor: 'rgb(34, 197, 94)',
                    backgroundColor: 'rgba(34, 197, 94, 0.1)',
                    tension: 0.4
                }, {
                    label: 'Salidas',
                    data: [100, 150, 250, 400, 180, 280],
                    borderColor: 'rgb(249, 115, 22)',
                    backgroundColor: 'rgba(249, 115, 22, 0.1)',
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Gráfico de Stock (Dona)  
        const ctx2 = document.getElementById('stockChart').getContext('2d');
        new Chart(ctx2, {
            type: 'doughnut',
            data: {
                labels: ['Stock Normal', 'Stock Bajo', 'Sin Stock'],
                datasets: [{
                    data: [65, 25, 10],
                    backgroundColor: [
                        'rgb(34, 197, 94)',
                        'rgb(251, 191, 36)',
                        'rgb(239, 68, 68)'
                    ],
                    borderWidth: 2,
                    borderColor: '#fff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                    }
                }
            }
        });
    });
</script>
@endsection