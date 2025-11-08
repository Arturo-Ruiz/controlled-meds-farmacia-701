<?php  
  
namespace App\Http\Controllers;  
  
use Illuminate\Http\Request;  
use Illuminate\Support\Facades\DB;  
use App\Models\Medicament;  
use App\Models\MedicamentType;  
use App\Models\Entry;  
use App\Models\Dispatch;  
use Barryvdh\DomPDF\Facade\Pdf;  
use Carbon\Carbon;  
  
class ReportController extends Controller  
{  
    public function index()  
    {  
        $medicamentTypes = MedicamentType::all();  
        return view('reports.index', compact('medicamentTypes'));  
    }  
  
    public function generateMonthlyReport(Request $request)  
    {  
        $request->validate([  
            'month' => 'required|integer|min:1|max:12',  
            'year' => 'required|integer|min:2020|max:2100',  
            'medicament_type_id' => 'required|exists:medicament_types,id'  
        ]);  
  
        $month = $request->month;  
        $year = $request->year;  
        $medicamentTypeId = $request->medicament_type_id;  
  
        // Obtener el tipo de medicamento  
        $medicamentType = MedicamentType::find($medicamentTypeId);  
  
        // Calcular fechas  
        $startOfMonth = Carbon::create($year, $month, 1)->startOfDay();  
        $endOfMonth = Carbon::create($year, $month, 1)->endOfMonth()->endOfDay();  
        $endOfPreviousMonth = Carbon::create($year, $month, 1)->subDay()->endOfDay();  
  
        // Obtener todos los principios activos con medicamentos de este tipo  
        $activeIngredients = DB::table('active_ingredients')  
            ->join('medicaments', 'medicaments.active_ingredient_id', '=', 'active_ingredients.id')  
            ->where('medicaments.medicament_type_id', $medicamentTypeId)  
            ->select('active_ingredients.id', 'active_ingredients.name')  
            ->distinct()  
            ->get();  
  
        $reportData = [];  
  
        foreach ($activeIngredients as $activeIngredient) {  
            // Obtener todos los medicamentos con este principio activo  
            $medicamentIds = Medicament::where('active_ingredient_id', $activeIngredient->id)  
                ->where('medicament_type_id', $medicamentTypeId)  
                ->pluck('id');  
  
            if ($medicamentIds->isEmpty()) {  
                continue;  
            }  
  
            // Obtener drogerías únicas del mes  
            $drugstores = Entry::whereIn('medicament_id', $medicamentIds)  
                ->whereMonth('entries.created_at', $month)  
                ->whereYear('entries.created_at', $year)  
                ->with('drugstore')  
                ->get()  
                ->pluck('drugstore.name')  
                ->unique()  
                ->filter()  
                ->implode(', ');  
  
            // Obtener números de factura únicos del mes  
            $invoiceNumbers = Entry::whereIn('medicament_id', $medicamentIds)  
                ->whereMonth('entries.created_at', $month)  
                ->whereYear('entries.created_at', $year)  
                ->pluck('invoice_number')  
                ->unique()  
                ->filter()  
                ->implode(', ');  
  
            // Calcular existencia anterior (al final del mes anterior)  
            $previousStock = $this->calculateStockAtDate($medicamentIds, $endOfPreviousMonth);  
  
            // Calcular entradas del mes (en unidades posológicas)  
            $entries = Entry::whereIn('medicament_id', $medicamentIds)  
                ->whereMonth('entries.created_at', $month)  
                ->whereYear('entries.created_at', $year)  
                ->join('medicaments', 'entries.medicament_id', '=', 'medicaments.id')  
                ->sum(DB::raw('entries.stock * medicaments.posological_units'));  
  
            // Calcular salidas del mes (en unidades posológicas)  
            $dispatches = Dispatch::whereIn('medicament_id', $medicamentIds)  
                ->whereMonth('dispatches.created_at', $month)  
                ->whereYear('dispatches.created_at', $year)  
                ->join('medicaments', 'dispatches.medicament_id', '=', 'medicaments.id')  
                ->sum(DB::raw('dispatches.amount * medicaments.posological_units'));  
  
            // Calcular existencia actual (al final del mes seleccionado)  
            $currentStock = $this->calculateStockAtDate($medicamentIds, $endOfMonth);  
  
            $reportData[] = [  
                'product_name' => $activeIngredient->name,  
                'drugstores' => $drugstores ?: 'N/A',  
                'invoice_numbers' => $invoiceNumbers ?: 'N/A',  
                'previous_stock' => $previousStock,  
                'entries' => $entries,  
                'dispatches' => $dispatches,  
                'current_stock' => $currentStock  
            ];  
        }  
  
        // Generar PDF  
        $pdf = PDF::loadView('reports.monthly-pdf', [  
            'reportData' => $reportData,  
            'month' => $month,  
            'year' => $year,  
            'medicamentType' => $medicamentType,  
            'monthName' => Carbon::create($year, $month, 1)->locale('es')->monthName  
        ]);  
  
        return $pdf->download("reporte_mensual_{$medicamentType->name}_{$month}_{$year}.pdf");  
    }  
  
    private function calculateStockAtDate($medicamentIds, $date)  
    {  
        $totalStock = 0;  
  
        foreach ($medicamentIds as $medicamentId) {  
            $medicament = Medicament::find($medicamentId);  
              
            // Obtener todas las entradas hasta la fecha  
            $totalEntries = Entry::where('medicament_id', $medicamentId)  
                ->where('entries.created_at', '<=', $date)  
                ->sum('stock');  
  
            // Obtener todas las salidas hasta la fecha  
            $totalDispatches = Dispatch::where('medicament_id', $medicamentId)  
                ->where('dispatches.created_at', '<=', $date)  
                ->sum('amount');  
  
            // Calcular stock en unidades posológicas  
            $stockInUnits = ($totalEntries - $totalDispatches) * $medicament->posological_units;  
            $totalStock += $stockInUnits;  
        }  
  
        return $totalStock;  
    }  
}