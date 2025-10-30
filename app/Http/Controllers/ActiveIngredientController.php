<?php

namespace App\Http\Controllers;

use App\Models\ActiveIngredient;
use App\Http\Requests\ActiveIngredientRequest;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ActiveIngredientController extends Controller
{
    public function index(Request $request)
    {
        $query = ActiveIngredient::query();

        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $activeIngredients = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('active-ingredients.index', compact('activeIngredients'));
    }

    public function store(ActiveIngredientRequest $request): JsonResponse
    {
        try {
            $activeIngredient = ActiveIngredient::create($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Principio activo creado exitosamente',
                'activeIngredient' => $activeIngredient
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear el principio activo'
            ], 500);
        }
    }

    public function show(ActiveIngredient $activeIngredient): JsonResponse
    {
        return response()->json([
            'success' => true,
            'activeIngredient' => $activeIngredient
        ]);
    }

    public function update(ActiveIngredientRequest $request, ActiveIngredient $activeIngredient): JsonResponse
    {
        try {
            $activeIngredient->update($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Principio activo actualizado exitosamente',
                'activeIngredient' => $activeIngredient
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar el principio activo'
            ], 500);
        }
    }

    public function destroy(ActiveIngredient $activeIngredient): JsonResponse
    {
        try {
            $activeIngredient->delete();

            return response()->json([
                'success' => true,
                'message' => 'Principio activo eliminado exitosamente'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar el principio activo'
            ], 500);
        }
    }
}
