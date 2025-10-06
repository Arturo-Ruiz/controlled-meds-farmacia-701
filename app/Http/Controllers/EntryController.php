<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Models\Entry;
use App\Models\Laboratory;
use App\Models\Medicament;
use App\Http\Requests\EntryRequest;

class EntryController extends Controller
{
    public function index(Request $request)
    {
        $query = Entry::with(['laboratory', 'medicament']);

        // Filtro existente por búsqueda  
        if ($request->filled('search')) {
            $query->where('invoice_number', 'LIKE', '%' . $request->search . '%')
                ->orWhereHas('laboratory', function ($q) use ($request) {
                    $q->where('name', 'LIKE', '%' . $request->search . '%');
                })
                ->orWhereHas('medicament', function ($q) use ($request) {
                    $q->where('name', 'LIKE', '%' . $request->search . '%');
                });
        }

        // AGREGAR FILTRO POR FECHA  
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

        $entries = $query->latest()->paginate(10);
        $laboratories = Laboratory::all();
        $medicaments = Medicament::all();

        return view('entries.index', compact('entries', 'laboratories', 'medicaments'));
    }

    public function store(EntryRequest $request): JsonResponse
    {
        try {
            DB::beginTransaction();

            $entries = [];

            foreach ($request->medicaments as $medicamentData) {
                $medicament = Medicament::find($medicamentData['medicament_id']);

                $entry = Entry::create([
                    'invoice_number' => $request->invoice_number,
                    'laboratory_id' => $request->laboratory_id,
                    'medicament_id' => $medicamentData['medicament_id'],
                    'stock' => $medicamentData['stock'],
                    'price' => $medicamentData['price'],
                    'current_stock' => $medicament->stock,
                    'final_stock' => $medicament->stock + $medicamentData['stock']
                ]);

                $medicament->update([
                    'stock' => $medicament->stock + $medicamentData['stock'],
                    'price' => $medicamentData['price']
                ]);

                $entries[] = $entry;
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Entradas registradas exitosamente',
                'entries' => $entries,
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'Error al registrar las entradas: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function show(Entry $entry): JsonResponse
    {
        $entry->load(['laboratory', 'medicament']);
        return response()->json([
            'success' => true,
            'entry' => $entry
        ]);
    }

    public function update(EntryRequest $request, Entry $entry): JsonResponse
    {
        try {
            DB::beginTransaction();

            // Revertir la entrada anterior del medicamento original  
            $oldMedicament = Medicament::find($entry->medicament_id);
            $oldMedicament->update([
                'stock' => $entry->current_stock // Restaurar al stock que había antes de esta entrada  
            ]);

            // Obtener el medicamento nuevo (puede ser el mismo o diferente)  
            $newMedicament = Medicament::find($request->medicament_id);

            // Actualizar la entrada con nuevos valores de seguimiento  
            $entry->update([
                'invoice_number' => $request->invoice_number,
                'laboratory_id' => $request->laboratory_id,
                'medicament_id' => $request->medicament_id,
                'stock' => $request->stock,
                'price' => $request->price,
                'current_stock' => $newMedicament->stock, // Stock actual del medicamento  
                'final_stock' => $newMedicament->stock + $request->stock // Stock después de la nueva entrada  
            ]);

            // Aplicar la nueva entrada al medicamento  
            $newMedicament->update([
                'stock' => $newMedicament->stock + $request->stock,
                'price' => $request->price
            ]);

            DB::commit();
            $entry->load(['medicament', 'laboratory']);

            return response()->json([
                'success' => true,
                'message' => 'Entrada actualizada exitosamente',
                'entry' => $entry
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar la entrada: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy(Entry $entry): JsonResponse
    {
        try {
            DB::beginTransaction();

            // Revertir el stock del medicamento usando current_stock  
            $medicament = Medicament::find($entry->medicament_id);
            $medicament->update([
                'stock' => $entry->current_stock
            ]);

            $entry->delete();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Entrada eliminada exitosamente'
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar la entrada: ' . $e->getMessage()
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
                'current_stock' => $medicament->stock,
                'current_price' => $medicament->price,
                'posological_units' => $medicament->posological_units  
            ]
        ]);
    }
}
