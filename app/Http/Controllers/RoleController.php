<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use App\Models\User;
class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('roles.index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::all();
        return view('roles.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $role = Role::create($request->only('name'));

        $permissions = $request->input('permissions');
        if ($permissions) {
            $role->syncPermissions($permissions);
        }

        return redirect()->route('roles.index')->with('success', 'Rol creado con éxito');
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('roles.edit', compact('role', 'permissions'));
    }

    public function update(Request $request, Role $role)
    {
       
        $role->update($request->only('name'));

        $permissions = $request->input('permissions');
        
        if ($permissions) {
            // Verificar que los permisos existan antes de asignarlos al rol
            $existingPermissions = Permission::whereIn('id', $permissions)->pluck('id');
            
            if ($existingPermissions->count() != count($permissions)) {
                // Algunos permisos seleccionados no existen
                return redirect()->back()->with('error', 'Uno o más permisos seleccionados no existen.');
            }
        
            // Asignar los permisos al rol
            $role->syncPermissions($existingPermissions);
        }
        
       
       
        
      
        return redirect()->route('roles.index')->with('success', 'Rol actualizado con éxito');
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('roles.index')->with('success', 'Rol eliminado con éxito');
    }
    public function  editarUsuario(User $user)
    {
        $roles = Role::all(); // Obtener todos los roles
        return view('roles.editarUser', compact('user', 'roles'));
    }
    public function  indexUSerRoles()
    {
        $users = User::with('roles')->get(); 
        return view('roles.userRoles', compact('users'));
    
    }
}