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
                    <p class="text-3xl font-bold text-gray-900 stat-number">{{ $totalMedicaments }}</p>

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
                    <p class="text-3xl font-bold text-gray-900 stat-number">{{ $entriesThisMonth }}</p>

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
                    <p class="text-3xl font-bold text-gray-900 stat-number">{{ $dispatchesThisMonth }}</p>

                </div>
                <div class="p-4 bg-gradient-to-br from-orange-500 to-orange-600 rounded-xl">
                    <i class="fas fa-arrow-up text-white text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 mb-1">Ventas del Mes</p>
                    <p class="text-3xl font-bold text-gray-900">${{ number_format($salesThisMonth, 2) }}</p>
                </div>
                <div class="p-4 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-xl">
                    <i class="fas fa-dollar-sign text-white text-2xl"></i>
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
                Cantidad de Movimientos (Últimos 6 meses)
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

    <!-- Alertas de Stock Bajo -->
    <div class="bg-gradient-to-r from-red-50 to-orange-50 border border-red-200 rounded-2xl p-6 shadow-lg">
        <div class="flex items-center mb-4">
            <div class="p-2 bg-red-100 rounded-lg mr-3">
                <i class="fas fa-exclamation-triangle text-red-600 text-xl"></i>
            </div>
            <h3 class="text-lg font-semibold text-red-800">Alertas de Stock Bajo</h3>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($stockAlerts as $medicament)
            @php
            $isCritical = $medicament->stock < $medicament->min_stock;
                $isLow = $medicament->stock >= $medicament->min_stock && $medicament->stock <= ($medicament->min_stock + 5);

                    if ($isCritical) {
                    $borderClass = 'border-red-100';
                    $badgeClass = 'bg-red-100 text-red-800';
                    $badgeText = 'Crítico';
                    } elseif ($isLow) {
                    $borderClass = 'border-orange-100';
                    $badgeClass = 'bg-orange-100 text-orange-800';
                    $badgeText = 'Bajo';
                    }
                    @endphp

                    <div class="bg-white rounded-xl p-4 border {{ $borderClass }}">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="font-medium text-gray-900">{{ $medicament->name }}</p>
                                <p class="text-sm text-gray-600">Stock actual: {{ $medicament->stock }} unidades</p>
                            </div>
                            <span class="px-2 py-1 {{ $badgeClass }} text-xs font-medium rounded-full">{{ $badgeText }}</span>
                        </div>
                    </div>
                    @endforeach
        </div>
    </div>

    <!-- Alertas de Vencimientos -->
    <div class="bg-gradient-to-r from-orange-50 to-red-50 border border-orange-200 rounded-2xl p-6 shadow-lg">
        <div class="flex items-center mb-4">
            <div class="p-2 bg-orange-100 rounded-lg mr-3">
                <i class="fas fa-calendar-times text-orange-600 text-xl"></i>
            </div>
            <h3 class="text-lg font-semibold text-orange-800">Alerta de Vencimiento de Medicamentos</h3>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($expirationAlerts as $medicament)
            @php
            $isExpired = $medicament->expiration_date < now();
                $expiresThisMonth=$medicament->expiration_date->month == now()->month &&
                $medicament->expiration_date->year == now()->year;

                if ($isExpired) {
                $borderClass = 'border-red-100';
                $badgeClass = 'bg-red-100 text-red-800';
                $badgeText = 'Vencido';
                } elseif ($expiresThisMonth) {
                $borderClass = 'border-orange-100';
                $badgeClass = 'bg-orange-100 text-orange-800';
                $badgeText = 'Vence este mes';
                }
                @endphp

                <div class="bg-white rounded-xl p-4 border {{ $borderClass }}">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="font-medium text-gray-900">{{ $medicament->name }}</p>
                            <p class="text-sm text-gray-600">Vence: {{ $medicament->expiration_date->format('d/m/Y') }}</p>
                        </div>
                        <span class="px-2 py-1 {{ $badgeClass }} text-xs font-medium rounded-full">{{ $badgeText }}</span>
                    </div>
                </div>
                @endforeach
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
                    <!-- Entradas Recientes -->
                    @forelse($recentEntries as $entry)
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors duration-200">
                        <div class="flex items-center">
                            <div class="p-2 bg-green-100 rounded-lg mr-4">
                                <i class="fas fa-pills text-green-600"></i>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900">{{ $entry->medicament->name }} - {{ $entry->medicament->presentation }}</p>
                                <p class="text-sm text-gray-600">{{ $entry->stock }} unidades → Laboratorio: {{ $entry->laboratory->name ?? 'Sin laboratorio' }}</p>
                                <p class="text-xs text-gray-500">
                                    <span class="mr-3">
                                        <i class="fas fa-capsules mr-1"></i>
                                        {{ $entry->medicament->posological_units }} Unidades Posológicas
                                    </span>
                                    <span class="mr-3">
                                        <i class="fas fa-dollar-sign mr-1"></i>
                                        ${{ number_format($entry->medicament->price, 2) }}
                                    </span>
                                </p>
                                <!-- Nueva línea para stock anterior y final -->
                                <p class="text-xs text-blue-600 mt-1">
                                    <span class="mr-3">
                                        <i class="fas fa-chart-line mr-1"></i>
                                        Stock anterior: {{ $entry->current_stock }}
                                    </span>
                                    <span>
                                        <i class="fas fa-arrow-right mr-1"></i>
                                        Stock final: {{ $entry->final_stock }}
                                    </span>
                                </p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="font-semibold text-green-600">+{{ $entry->stock }} unidades</p>
                            <p class="text-sm text-gray-500">{{ $entry->created_at->diffForHumans() }}</p>
                            <!-- Información adicional de stock en el lado derecho -->
                           
                            <p class="text-sm font-medium text-gray-700"> Stock: <span class="text-xs text-gray-500">{{ $entry->current_stock }}</span>
                                → <span class="text-green-600">{{ $entry->final_stock }}</span> </p>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-8 text-gray-500">
                        <p>No hay entradas recientes</p>
                    </div>
                    @endforelse
                </div>
                <div class="mt-4 text-center">
                    <a href="{{ route('entries.index') }}" class="text-green-600 hover:text-green-700 font-medium text-sm">
                        Ver todas las entradas →
                    </a>
                </div>
            </div>
        </div>

        <!-- Salidas Recientes -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-100 bg-gradient-to-r from-orange-50 to-orange-100">
                <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                    <i class="fas fa-arrow-up text-orange-600 mr-3"></i>
                    Salidas Recientes
                </h3>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    <!-- Salidas Recientes -->
                    @forelse($recentDispatches as $dispatch)
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors duration-200">
                        <div class="flex items-center">
                            <div class="p-2 bg-orange-100 rounded-lg mr-4">
                                <i class="fas fa-prescription-bottle text-orange-600"></i>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900">{{ $dispatch->medicament->name }}</p>
                                <p class="text-sm text-gray-600">{{ $dispatch->medicament->presentation }} - Unidades Posológicas: {{ $dispatch->medicament->posological_units }}</p>
                                <p class="text-sm text-gray-500">{{ $dispatch->amount }} unidades → {{ $dispatch->user->name }}</p>
                                <p class="text-xs text-blue-600 font-medium">Motivo: {{ $dispatch->reason }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="font-semibold text-orange-600">-{{ $dispatch->amount }} unidades</p>
                            <p class="text-sm text-gray-500">${{ number_format($dispatch->medicament->price, 2) }} c/u</p>
                            <p class="text-sm font-medium text-gray-700">Total: ${{ number_format($dispatch->amount * $dispatch->medicament->price, 2) }}</p>
                            <p class="text-xs text-gray-500">{{ $dispatch->created_at->diffForHumans() }}</p>
                            <p class="text-sm font-medium text-gray-700"> Stock: <span class="text-xs text-gray-500">{{ $dispatch->current_stock }}</span>
                                → <span class="text-orange-600">{{ $dispatch->final_stock }}</span> </p>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-8 text-gray-500">
                        <i class="fas fa-inbox text-gray-400 text-3xl mb-2"></i>
                        <p>No hay salidas recientes</p>
                    </div>
                    @endforelse
                </div>
                <div class="mt-4 text-center">
                    <a href="{{ route('dispatches.index') }}" class="text-orange-600 hover:text-orange-700 font-medium text-sm">
                        Ver todas las salidas →
                    </a>
                </div>
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
        const movementsData = @json($movementsData);

        new Chart(ctx1, {
            type: 'line',
            data: {
                labels: movementsData.months,
                datasets: [{
                    label: 'Entradas',
                    data: movementsData.entries,
                    borderColor: 'rgb(34, 197, 94)',
                    backgroundColor: 'rgba(34, 197, 94, 0.1)',
                    tension: 0.4,
                    fill: true
                }, {
                    label: 'Salidas',
                    data: movementsData.dispatches,
                    borderColor: 'rgb(249, 115, 22)',
                    backgroundColor: 'rgba(249, 115, 22, 0.1)',
                    tension: 0.4,
                    fill: true
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
        const stockDistribution = @json($stockDistribution);

        new Chart(ctx2, {
            type: 'doughnut',
            data: {
                labels: ['Stock Normal', 'Stock Bajo', 'Stock Crítico'],
                datasets: [{
                    data: [
                        stockDistribution.normal,
                        stockDistribution.low,
                        stockDistribution.critical
                    ],
                    backgroundColor: [
                        'rgb(34, 197, 94)', // Verde para normal  
                        'rgb(251, 191, 36)', // Amarillo para bajo  
                        'rgb(239, 68, 68)' // Rojo para crítico  
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