<?php  
  
namespace App\Http\Controllers;  
  
use Illuminate\Http\Request;  
use Illuminate\Http\JsonResponse;  
use Illuminate\Support\Facades\Hash;  
use App\Models\User;  
use App\Http\Requests\UserRequest;  
  
class UserController extends Controller  
{  
    public function index(Request $request)  
    {  
        $query = User::query();  
  
        if ($request->filled('search')) {  
            $query->where('name', 'LIKE', '%' . $request->search . '%')  
                  ->orWhere('email', 'LIKE', '%' . $request->search . '%');  
        }  
  
        $users = $query->latest()->paginate(10);  
  
        return view('users.index', compact('users'));  
    }  
  
    public function store(UserRequest $request): JsonResponse  
    {  
        try {  
            $data = $request->validated();  
            $data['password'] = Hash::make($data['password']);  
              
            $user = User::create($data);  
  
            return response()->json([  
                'success' => true,  
                'message' => 'Usuario creado exitosamente',  
                'user' => $user,  
            ]);  
        } catch (\Exception $e) {  
            return response()->json([  
                'success' => false,  
                'message' => 'Error al crear el usuario: ' . $e->getMessage(),  
            ], 500);  
        }  
    }  
  
    public function show(User $user): JsonResponse  
    {  
        return response()->json([  
            'success' => true,  
            'user' => $user  
        ]);  
    }  
  
    public function update(UserRequest $request, User $user): JsonResponse  
    {  
        try {  
            $data = $request->validated();  
              
            if (!empty($data['password'])) {  
                $data['password'] = Hash::make($data['password']);  
            } else {  
                unset($data['password']);  
            }  
              
            $user->update($data);  
  
            return response()->json([  
                'success' => true,  
                'message' => 'Usuario actualizado exitosamente',  
                'user' => $user  
            ]);  
        } catch (\Exception $e) {  
            return response()->json([  
                'success' => false,  
                'message' => 'Error al actualizar el usuario: ' . $e->getMessage()  
            ], 500);  
        }  
    }  
  
    public function destroy(User $user): JsonResponse  
    {  
        try {  
            $user->delete();  
  
            return response()->json([  
                'success' => true,  
                'message' => 'Usuario eliminado exitosamente'  
            ]);  
        } catch (\Exception $e) {  
            return response()->json([  
                'success' => false,  
                'message' => 'Error al eliminar el usuario: ' . $e->getMessage()  
            ], 500);  
        }  
    }  
}