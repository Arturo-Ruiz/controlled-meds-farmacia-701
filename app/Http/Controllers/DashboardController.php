<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medicament;
use App\Models\Entry;
use App\Models\Dispatch;
use Carbon\Carbon;

use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Métricas principales basadas en tu estructura actual  
        $totalMedicaments = Medicament::count();
        $lowStock = Medicament::whereRaw('stock >= min_stock AND stock <= (min_stock + 1)')->count();

        // Entradas y salidas del mes actual (usando 'amount' no 'quantity')  
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        $entriesThisMonth = Entry::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->sum('stock');

        $dispatchesThisMonth = Dispatch::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->sum('amount');

        $salesThisMonth = Dispatch::whereMonth('dispatches.created_at', $currentMonth)
            ->whereYear('dispatches.created_at', $currentYear)
            ->where('reason', 'Venta')
            ->join('medicaments', 'dispatches.medicament_id', '=', 'medicaments.id')
            ->sum(DB::raw('dispatches.amount * medicaments.price'));

        // Medicamentos con stock crítico para las alertas  

        $stockAlerts = Medicament::whereRaw('stock <= (min_stock + 1)')
            ->orderByRaw('CASE   
                            WHEN stock < min_stock THEN 1   
                            WHEN stock >= min_stock AND stock <= (min_stock + 1) THEN 2   
                            ELSE 3   
                        END')
            ->orderBy('stock', 'asc')
            ->take(3)
            ->get();

        $expirationAlerts = Medicament::where(function ($query) {
            $query->where('expiration_date', '<', now()) // Vencidos  
                ->orWhere(function ($subQuery) {
                    $subQuery->whereMonth('expiration_date', now()->month)
                        ->whereYear('expiration_date', now()->year); // Vencen este mes  
                });
        })
            ->orderByRaw('CASE WHEN expiration_date < NOW() THEN 1 ELSE 2 END')
            ->orderBy('expiration_date', 'asc')
            ->take(3)
            ->get();

        $movementsData = $this->getMovementsData();
        $stockDistribution = $this->getStockDistribution();

        $recentEntries = Entry::with(['medicament', 'laboratory'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Salidas recientes con usuario responsable    
        $recentDispatches = Dispatch::with(['medicament', 'user'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();



        return view('dashboard.index', compact(
            'totalMedicaments',
            'lowStock',
            'entriesThisMonth',
            'dispatchesThisMonth',
            'salesThisMonth',
            'stockAlerts',
            'expirationAlerts',
            'movementsData',
            'stockDistribution',
            'recentEntries',
            'recentDispatches',
        ));
    }


    private function getMovementsData()
    {
        $months = [];
        $entriesData = [];
        $dispatchesData = [];

        // Obtener datos de los últimos 6 meses  
        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $monthName = $date->format('M');
            $months[] = $monthName;

            // Entradas del mes  
            $entriesCount = Entry::whereMonth('created_at', $date->month)
                ->whereYear('created_at', $date->year)
                ->sum('stock');
            $entriesData[] = $entriesCount;

            // Salidas del mes  
            $dispatchesCount = Dispatch::whereMonth('dispatches.created_at', $date->month)
                ->whereYear('dispatches.created_at', $date->year)
                ->sum('amount');
            $dispatchesData[] = $dispatchesCount;
        }

        return [
            'months' => $months,
            'entries' => $entriesData,
            'dispatches' => $dispatchesData
        ];
    }

    private function getStockDistribution()
    {
        // Stock crítico (menos del mínimo)  
        $criticalStock = Medicament::whereRaw('stock < min_stock')->count();

        // Stock bajo (entre mínimo y mínimo + 5)  
        $lowStock = Medicament::whereRaw('stock >= min_stock AND stock <= (min_stock + 1)')->count();

        // Stock normal (más de mínimo + 5)  
        $normalStock = Medicament::whereRaw('stock > (min_stock + 1)')->count();

        return [
            'critical' => $criticalStock,
            'low' => $lowStock,
            'normal' => $normalStock
        ];
    }
}
