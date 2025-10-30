<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Dispatch;
use App\Models\Medicament;
use App\Http\Requests\DispatchRequest;

class DispatchController extends Controller
{
    public function index(Request $request)
    {
        $query = Dispatch::with(['user', 'medicament']);

        // Filtro existente por búsqueda  
        if ($request->filled('search')) {
            $query->where('reason', 'LIKE', '%' . $request->search . '%')
                ->orWhereHas('medicament', function ($q) use ($request) {
                    $q->where('name', 'LIKE', '%' . $request->search . '%');
                })
                ->orWhereHas('user', function ($q) use ($request) {
                    $q->where('name', 'LIKE', '%' . $request->search . '%');
                });
        }

        if ($request->filled('date_filter') && $request->date_filter !== 'all') {
            $now = now();

            switch ($request->date_filter) {
                case 'this_month':
                    $query->whereMonth('created_at', $now->month)
                        ->whereYear('created_at', $now->year);
                    break;
                case 'last_3_months':
                    $query->whereBetween('created_at', [
                        $now->copy()->subMonths(3)->startOfDay(),
                        $now->endOfDay()
                    ]);
                    break;
                case 'last_6_months':
                    $query->whereBetween('created_at', [
                        $now->copy()->subMonths(6)->startOfDay(),
                        $now->endOfDay()
                    ]);
                    break;
                case 'this_year':
                    $query->whereYear('created_at', $now->year);
                    break;
            }
        }

        $dispatches = $query->latest()->paginate(10);
        $medicaments = Medicament::all();

        return view('dispatches.index', compact('dispatches', 'medicaments'));
    }

    public function store(DispatchRequest $request): JsonResponse
    {
        try {
            DB::beginTransaction();

            $dispatches = [];

            foreach ($request->medicaments as $medicamentData) {
                $medicament = Medicament::find($medicamentData['medicament_id']);

                if ($medicament->stock < $medicamentData['amount']) {
                    DB::rollback();
                    return response()->json([
                        'success' => false,
                        'message' => "Stock insuficiente para {$medicament->name}. Stock actual: {$medicament->stock}"
                    ], 400);
                }

                $dispatch = Dispatch::create([
                    'user_id' => Auth::id(),
                    'medicament_id' => $medicamentData['medicament_id'],
                    'amount' => $medicamentData['amount'],
                    'reason' => $request->reason,
                    'current_stock' => $medicament->stock,
                    'final_stock' => $medicament->stock - $medicamentData['amount']
                ]);

                // Actualizar el stock del medicamento  
                $medicament->update([
                    'stock' => $medicament->stock - $medicamentData['amount']
                ]);

                $dispatches[] = $dispatch;
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Salidas registradas exitosamente',
                'dispatches' => $dispatches,
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'Error al registrar las salidas: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function show(Dispatch $dispatch): JsonResponse
    {
        $dispatch->load(['user', 'medicament']);
        return response()->json([
            'success' => true,
            'dispatch' => $dispatch
        ]);
    }

    public function destroy(Dispatch $dispatch): JsonResponse
    {
        try {
            DB::beginTransaction();

            // Revertir el stock del medicamento  
            $medicament = Medicament::find($dispatch->medicament_id);
            $medicament->update([
                'stock' => $medicament->stock + $dispatch->amount
            ]);

            $dispatch->delete();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Salida eliminada exitosamente'
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar la salida: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getMedicamentData(Medicament $medicament): JsonResponse
    {
        return response()->json([
            'success' => true,
            'medicament' => [
                'id' => $medicament->id,
                'name' => $medicament->name,
                'presentation' => $medicament->presentation,
                'posological_units' => $medicament->posological_units,
                'current_stock' => $medicament->stock,
                'full_name' => $medicament->full_name
            ]
        ]);
    }
}
