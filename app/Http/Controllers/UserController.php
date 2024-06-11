<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Piso;
use App\Interfaces\NotificationInterface;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $NotificationRepository;
    public function __construct(NotificationInterface $NotificationRepository)
       {
           $this->NotificationRepository = $NotificationRepository;
       }
    public function index(request $request)
    {

         $pisos = Piso::all();
        
        $usuariosQuery = User::with(['pisos', 'roles']);

        // Filtrar por piso si se seleccionó uno
        if ($request->has('piso_id') && $request->piso_id != '') {
            $usuariosQuery->whereHas('pisos', function ($query) use ($request) {
                $query->where('pisos.id', $request->piso_id);
            });
        }

        $usuarios = $usuariosQuery->get();

        return view('personal.index', compact('pisos', 'usuarios'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function AsignarPiso(request $request)
    {
        $user = User::find($request->user_id);
        if ($user) {
            $user->pisos()->sync([$request->floor_id]);
            return redirect()->back()->with('success', 'Piso asignado exitosamente');
        }
        return redirect()->back()->with('error', 'Usuario no encontrado');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function cambiar()
    {
        return view('personal.cambiar');
    }

    public function rolUser($id,$userId)
    {
        $user = User::find($userId);
        $roles = Role::all();

    if (!$user) {
        return response()->json(['error' => 'User not found'], 404);
    }

    return response()->json([
        'user' => $user,
        'id' => $id,
        'roles' => $roles
    ]);
    }
    public function AsignaRol($id,$userId,$rol)
    {
            // Busca el usuario y el rol en la base de datos
    $user = User::find($userId);
    $role = Role::where('id', $rol)->first();

    // Verifica si el usuario y el rol existen
    if (!$user) {
        return response()->json(['error' => 'Usuario no encontrado'], 404);
    }

    if (!$role) {
        return response()->json(['error' => 'Rol no encontrado'], 404);
    }
         $user->roles()->attach($role->id);
         if($id != 1)
         {
            $this->NotificationRepository->markAsRead($id);
         }
         

    
    return response()->json(['message' => 'Rol asignado correctamente']);
    }

    public function actualizarContraseña(Request $request)
    {
        $request->validate([
            'contrasena_actual' => 'required',
            'nueva_contrasena' => 'required|string|min:8|confirmed',
        ]);

        $usuario = Auth::user();

        if (!Hash::check($request->contrasena_actual, $usuario->password)) {
            return back()->with('error', 'La contraseña actual es incorrecta.');
        }

        $usuario->password = Hash::make($request->nueva_contrasena);
        $usuario->save();

        return redirect()->route('home')->with('success', 'Contraseña cambiada correctamente.');
    }
    
}
