<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::all();
        return view('permissions.index', compact('permissions'));
    }

    public function create()
    {
        return view('permissions.create');
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|unique:permissions,name']);

        Permission::create(['name' => $request->input('name')]);
        return redirect()->route('permissions.index')->with('success', 'Permiso creado con éxito');
    }

    public function edit(Permission $permission)
    {
        return view('permissions.edit', compact('permission'));
    }

    public function update(Request $request, Permission $permission)
    {
        $request->validate(['name' => 'required|unique:permissions,name']);

        $permission->update(['name' => $request->input('name')]);
        return redirect()->route('permissions.index')->with('success', 'Permiso actualizado con éxito');
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();
        return redirect()->route('permissions.index')->with('success', 'Permiso eliminado con éxito');
    }
}