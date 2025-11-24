<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Requests\UserRequest;
use Spatie\Permission\Models\Role;
use App\Helpers\RoleHelper;



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

        $roles = Role::all()->map(function ($role) {
            return [
                'name' => $role->name,
                'display_name' => RoleHelper::translateRole($role->name)
            ];
        });

        return view('users.index', compact('users', 'roles'));
    }

    public function store(UserRequest $request): JsonResponse
    {
        try {
            $data = $request->validated();
            $data['password'] = Hash::make($data['password']);

            $user = User::create($data);

            // Asignar rol al usuario  
            if ($request->has('role')) {
                $user->assignRole($request->role);
            }

            return response()->json([
                'success' => true,
                'message' => 'Usuario creado exitosamente',
                'user' => $user->load('roles'),
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
            'user' => $user->load('roles')
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

            // Sincronizar rol (reemplaza el rol anterior)  
            if ($request->has('role')) {
                $user->syncRoles([$request->role]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Usuario actualizado exitosamente',
                'user' => $user->load('roles')
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
