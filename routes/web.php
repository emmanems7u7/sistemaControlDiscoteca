<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProovedorController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\RegistroVentaController;
use App\Http\Controllers\ConfiguracionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PisoController;
use App\Http\Controllers\ReporteController;
Route::get('/', function () {
    return view('auth.login');
});
Route::get('/home', function () {
    return view('home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');


Route::prefix('productos')->group(function () {
    Route::get('/', [ProductoController::class, 'index'])->name('productos.index')->middleware('auth');

    Route::get('/crear', [ProductoController::class, 'create'])->name('productos.create')->middleware('auth');
    Route::post('/', [ProductoController::class, 'store'])->name('productos.store')->middleware('auth');
    

    Route::get('/{producto}', [ProductoController::class, 'show'])->name('productos.show')->middleware('auth');
    

    Route::get('/ver/{id}', [ProductoController::class, 'showJson'])->name('productosJson.show')->middleware('auth');

    Route::get('/verr/{id}', [ProductoController::class, 'extraeProductos'])->name('extrae.show');
    Route::get('/categoria/{id}', [ProductoController::class, 'extraeProductosCategoria'])->name('extraeCategoria.show');
  

    Route::get('/{producto}/editar', [ProductoController::class, 'edit'])->name('productos.edit')->middleware('auth');
   
    Route::put('edit/{id}', [ProductoController::class, 'updateJson'])->name('productoJson.update')->middleware('auth');


    Route::put('/{producto}', [ProductoController::class, 'update'])->name('productos.update')->middleware('auth');
    Route::delete('/{producto}', [ProductoController::class, 'destroy'])->name('productos.destroy')->middleware('auth');
})->middleware('auth');

Route::resource('proveedores', ProovedorController::class)->middleware('auth');

Route::get('proveedor/{id}', [ProovedorController::class, 'extraeProovedorJson'])->name('proveedor.extraeP')->middleware('auth');

Route::resource('categorias', CategoriaController::class);
Route::get('categoria/{id}', [CategoriaController::class, 'extraeCategoriaJson'])->name('categoria.extraeP')->middleware('auth');

Route::resource('pedidos', PedidoController::class);

Route::get('all', [PedidoController::class, 'verPedidos'])->name('pedidos.all')->middleware('auth');
Route::get('pedidos/validar/{id}', [PedidoController::class, 'validar'])->name('pedidos.validar')->middleware('auth');
Route::get('pedidos/cancelar/{id}', [PedidoController::class, 'cancelar'])->name('pedidos.cancelar')->middleware('auth');

Route::get('pedidos/show/{id}/{UserId}/{venta}', [PedidoController::class, 'pedidos'])->name('pedidos.ver')->middleware('auth');


Route::resource('ventas', RegistroVentaController::class)->middleware('auth');
Route::post('/guardar/venta', [RegistroVentaController::class, 'GuardarVenta'])->name('venta.guardar')->middleware('auth');
Route::get('/registro/ventas', [RegistroVentaController::class, 'ventasR'])->name('ventasR.index')->middleware('auth');

Route::resource('configuracion', ConfiguracionController::class)->middleware('auth');

// Rutas para roles
Route::resource('roles', RoleController::class)->middleware('auth');

Route::get('roles/usuario/{user}/editar', [RoleController::class, 'editarUsuario'])->name('rolUser.editar')->middleware('auth');
Route::put('roles/usuario/{user}', 'UserController@actualizar')->name('rolUser.actualizar')->middleware('auth');
Route::get('ver/', [RoleController::class, 'indexUSerRoles'])->name('rolUser.index')->middleware('auth');


// Rutas para permisos
Route::resource('permissions', PermissionController::class)->middleware('auth');

Route::get('/cambiar-contrasena', [UserController::class, 'cambiar'])->name('cambiar_contrasena')->middleware('auth');
Route::post('/cambiar-contrasena', [UserController::class, 'actualizarContraseña'])->name('actualizar_contrasena')->middleware('auth');
Route::prefix('user')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('user.index')->middleware('auth');
    Route::get('/rol/{id}/{UserId}', [UserController::class, 'rolUser'])->name('UsuarioRol.show')->middleware('auth');
    Route::get('/asigna/{id}/{UserId}/{rol}', [UserController::class, 'AsignaRol'])->name('UsuarioAsigna.show')->middleware('auth');
    Route::get('/crear', [UserController::class, 'create'])->name('user.create')->middleware('auth');
    Route::post('/', [UserController::class, 'store'])->name('user.store')->middleware('auth');
    Route::get('/{user}', [UserController::class, 'show'])->name('user.show');
    Route::get('/ver/{id}', [UserController::class, 'showJson'])->name('userJson.show')->middleware('auth');
    Route::post('/asignar/piso', [UserController::class, 'AsignarPiso'])->name('asignar.piso')->middleware('auth');
    Route::get('/verf/{id}', [UserController::class, 'extraeuser'])->name('extraeu.show')->middleware('auth');

       //Route::get('/categoria/{id}', [UserController::class, 'extraeuserCategoria'])->name('extraeCategoria.show');
      
       

    Route::get('/{user}/editar', [UserController::class, 'edit'])->name('user.edit')->middleware('auth');
   
    Route::put('edit/{id}', [UserController::class, 'updateJson'])->name('userJson.update')->middleware('auth');


    Route::put('/{user}', [UserController::class, 'update'])->name('user.update')->middleware('auth');
    Route::delete('/{user}', [UserController::class, 'destroy'])->name('user.destroy')->middleware('auth');
});


Route::resource('pisos', PisoController::class)->middleware('auth');


Route::prefix('reporte')->group(function () {
    Route::post('/ventas', [ReporteController::class, 'ventas'])->name('Reporte.ventas')->middleware('auth');
  
    

      
});