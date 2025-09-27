<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

use App\Http\Requests\MedicamentRequest;
use App\Models\Medicament;

class MedicamentController extends Controller
{
    public function index()
    {
        $medicaments = Medicament::latest()->paginate(9);

        return view('medicaments.index', compact('medicaments'));
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
