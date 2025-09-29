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

        if ($request->filled('search')) {
            $query->where('invoice_number', 'LIKE', '%' . $request->search . '%')
                ->orWhereHas('laboratory', function ($q) use ($request) {
                    $q->where('name', 'LIKE', '%' . $request->search . '%');
                })
                ->orWhereHas('medicament', function ($q) use ($request) {
                    $q->where('name', 'LIKE', '%' . $request->search . '%');
                });
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

            // Crear la entrada  
            $entry = Entry::create($request->validated());

            // Actualizar el medicamento: sumar stock y actualizar precio  
            $medicament = Medicament::find($request->medicament_id);
            $medicament->update([
                'stock' => $medicament->stock + $request->stock, // Sumar al stock actual  
                'price' => $request->price // Actualizar precio  
            ]);

            DB::commit();
            $entry->load(['laboratory', 'medicament']);

            return response()->json([
                'success' => true,
                'message' => 'Entrada creada exitosamente',
                'entry' => $entry,
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'Error al crear la entrada: ' . $e->getMessage(),
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
                'stock' => $oldMedicament->stock - $entry->stock // Restar stock anterior  
            ]);

            // Actualizar la entrada  
            $entry->update($request->validated());

            // Aplicar la nueva entrada al medicamento (puede ser el mismo o diferente)  
            $newMedicament = Medicament::find($request->medicament_id);
            $newMedicament->update([
                'stock' => $newMedicament->stock + $request->stock, // Sumar nuevo stock  
                'price' => $request->price // Actualizar precio  
            ]);

            DB::commit();
            $entry->load(['laboratory', 'medicament']);

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

            // Revertir el stock del medicamento  
            $medicament = Medicament::find($entry->medicament_id);
            $medicament->update([
                'stock' => $medicament->stock - $entry->stock // Restar el stock de la entrada eliminada  
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
                'current_price' => $medicament->price
            ]
        ]);
    }
}
