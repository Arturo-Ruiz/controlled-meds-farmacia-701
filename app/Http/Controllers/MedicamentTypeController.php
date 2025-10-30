<?php

namespace App\Http\Controllers;

use App\Models\MedicamentType;
use App\Http\Requests\MedicamentTypeRequest;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class MedicamentTypeController extends Controller
{
    public function index(Request $request)
    {
        $query = MedicamentType::query();

        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $medicamentTypes = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('medicament-types.index', compact('medicamentTypes'));
    }

    public function store(MedicamentTypeRequest $request): JsonResponse
    {
        try {
            $medicamentType = MedicamentType::create($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Tipo de medicamento creado exitosamente',
                'medicamentType' => $medicamentType
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear el tipo de medicamento'
            ], 500);
        }
    }

    public function show(MedicamentType $medicamentType): JsonResponse
    {
        return response()->json([
            'success' => true,
            'medicamentType' => $medicamentType
        ]);
    }

    public function update(MedicamentTypeRequest $request, MedicamentType $medicamentType): JsonResponse
    {
        try {
            $medicamentType->update($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Tipo de medicamento actualizado exitosamente',
                'medicamentType' => $medicamentType
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar el tipo de medicamento'
            ], 500);
        }
    }

    public function destroy(MedicamentType $medicamentType): JsonResponse
    {
        try {
            $medicamentType->delete();

            return response()->json([
                'success' => true,
                'message' => 'Tipo de medicamento eliminado exitosamente'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar el tipo de medicamento'
            ], 500);
        }
    }
}
