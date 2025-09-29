<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

use App\Models\Laboratory;
use App\Http\Requests\LaboratoryRequest;


class LaboratoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Laboratory::query();

        if ($request->filled('search')) {
            $query->where('name', 'LIKE', '%' . $request->search . '%');
        }

        $laboratories = $query->latest()->paginate(10);

        return view('laboratories.index', compact('laboratories'));
    }

    public function store(LaboratoryRequest $request): JsonResponse
    {
        try {
            $laboratory = Laboratory::create($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Laboratorio creado exitosamente',
                'laboratory' => $laboratory,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear el laboratorio: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function show(Laboratory $laboratory): JsonResponse
    {
        return response()->json([
            'success' => true,
            'laboratory' => $laboratory
        ]);
    }

    public function update(LaboratoryRequest $request, Laboratory $laboratory): JsonResponse
    {
        try {
            $laboratory->update($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Laboratorio actualizado exitosamente',
                'laboratory' => $laboratory
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar el laboratorio: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy(Laboratory $laboratory): JsonResponse
    {
        try {
            $laboratory->delete();

            return response()->json([
                'success' => true,
                'message' => 'Laboratorio eliminado exitosamente'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar el laboratorio: ' . $e->getMessage()
            ], 500);
        }
    }
}
