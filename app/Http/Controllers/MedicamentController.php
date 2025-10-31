<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

use App\Http\Requests\MedicamentRequest;
use App\Models\Medicament;
use App\Models\Laboratory;
use App\Models\MedicamentType;
use App\Models\ActiveIngredient;

class MedicamentController extends Controller
{
    public function index(Request $request)
    {
        $query = Medicament::with(['laboratory', 'medicamentType', 'activeIngredient']);

        // Filtro por nombre  
        if ($request->filled('search')) {
            $query->where('name', 'LIKE', '%' . $request->search . '%');
        }

        // Filtro por estado de stock (usando tu nueva lógica)  
        if ($request->filled('status') && $request->status !== 'all') {
            switch ($request->status) {
                case 'critical':
                    $query->whereRaw('stock < min_stock');
                    break;
                case 'low':
                    $query->whereRaw('stock >= min_stock AND stock <= (min_stock + 1)');
                    break;
                case 'normal':
                    $query->whereRaw('stock > (min_stock + 1)');
                    break;
            }
        }

        // Filtro por fecha de vencimiento  
        if ($request->filled('expiration') && $request->expiration !== 'all') {
            $now = now();

            switch ($request->expiration) {
                case 'this_month':
                    $query->whereMonth('expiration_date', $now->month)
                        ->whereYear('expiration_date', $now->year);
                    break;
                case 'next_3_months':
                    $query->whereBetween('expiration_date', [
                        $now->startOfDay(),
                        $now->copy()->addMonths(3)->endOfDay()
                    ]);
                    break;
                case 'next_6_months':
                    $query->whereBetween('expiration_date', [
                        $now->startOfDay(),
                        $now->copy()->addMonths(6)->endOfDay()
                    ]);
                    break;
                case 'this_year':
                    $query->whereYear('expiration_date', $now->year);
                    break;
            }
        }

        $medicaments = $query->orderBy('name', 'asc')->simplePaginate(9);

        $laboratories = Laboratory::all();
        $medicamentTypes = MedicamentType::all();
        $activeIngredients = ActiveIngredient::all();

        return view('medicaments.index', compact('medicaments', 'laboratories', 'medicamentTypes', 'activeIngredients'));
    }

    public function store(MedicamentRequest $request): JsonResponse
    {
        try {
            $medicament = Medicament::create($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Medicamento creado exitosamente',
                'medicament' => $medicament,
                'toast' => [
                    'title' => '¡Éxito!',
                    'text' => "El medicamento '{$medicament->name}' ha sido registrado correctamente",
                    'icon' => 'success'
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear el medicamento: ' . $e->getMessage(),
                'toast' => [
                    'title' => 'Error',
                    'text' => 'No se pudo crear el medicamento',
                    'icon' => 'error'
                ]
            ], 500);
        }
    }

    public function show(Medicament $medicament): JsonResponse
    {
        return response()->json([
            'success' => true,
            'medicament' => $medicament
        ]);
    }



    public function update(MedicamentRequest $request, Medicament $medicament): JsonResponse
    {
        try {
            $medicament->update($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Medicamento actualizado exitosamente',
                'medicament' => $medicament
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar el medicamento: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy(Medicament $medicament): JsonResponse
    {
        try {
            $medicament->delete();

            return response()->json([
                'success' => true,
                'message' => 'Medicamento eliminado exitosamente'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar el medicamento: ' . $e->getMessage()
            ], 500);
        }
    }
}
