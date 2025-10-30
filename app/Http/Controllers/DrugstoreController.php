<?php

namespace App\Http\Controllers;  
  
use App\Models\Drugstore;  
use App\Http\Requests\DrugstoreRequest;  
use Illuminate\Http\Request;  
  
class DrugstoreController extends Controller  
{  
    /**  
     * Display a listing of the resource.  
     */  
    public function index(Request $request)  
    {  
        $query = Drugstore::query();  
  
        if ($request->has('search') && $request->search != '') {  
            $query->where('name', 'like', '%' . $request->search . '%');  
        }  
  
        $drugstores = $query->orderBy('created_at', 'desc')->paginate(10);  
  
        return view('drugstores.index', compact('drugstores'));  
    }  
  
    /**  
     * Store a newly created resource in storage.  
     */  
    public function store(DrugstoreRequest $request)  
    {  
        try {  
            $drugstore = Drugstore::create($request->validated());  
  
            return response()->json([  
                'success' => true,  
                'message' => 'Droguería creada exitosamente',  
                'drugstore' => $drugstore  
            ]);  
        } catch (\Exception $e) {  
            return response()->json([  
                'success' => false,  
                'message' => 'Error al crear la droguería'  
            ], 500);  
        }  
    }  
  
    /**  
     * Display the specified resource.  
     */  
    public function show(Drugstore $drugstore)  
    {  
        return response()->json([  
            'success' => true,  
            'drugstore' => $drugstore  
        ]);  
    }  
  
    /**  
     * Update the specified resource in storage.  
     */  
    public function update(DrugstoreRequest $request, Drugstore $drugstore)  
    {  
        try {  
            $drugstore->update($request->validated());  
  
            return response()->json([  
                'success' => true,  
                'message' => 'Droguería actualizada exitosamente',  
                'drugstore' => $drugstore  
            ]);  
        } catch (\Exception $e) {  
            return response()->json([  
                'success' => false,  
                'message' => 'Error al actualizar la droguería'  
            ], 500);  
        }  
    }  
  
    /**  
     * Remove the specified resource from storage.  
     */  
    public function destroy(Drugstore $drugstore)  
    {  
        try {  
            $drugstore->delete();  
  
            return response()->json([  
                'success' => true,  
                'message' => 'Droguería eliminada exitosamente'  
            ]);  
        } catch (\Exception $e) {  
            return response()->json([  
                'success' => false,  
                'message' => 'Error al eliminar la droguería'  
            ], 500);  
        }  
    }  
}