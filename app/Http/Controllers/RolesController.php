<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::paginate(5);
        // return response()->json($roles);
        return Inertia::render('Roles/Index', [
            'roles' => $roles
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Roles/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // session()->flash('success', 'Rol creado correctamente');   // Otra opcion para mostrar mensajes
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name'
        ]);

        $role = new Role();
        $role->name = strtoupper($request->name);
        $role->save();
        return to_route('admin.roles.index')
            ->with("message", "Rol creado exitosamente")
            ->with("icon", "success");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $rol = Role::find($id);
        return Inertia::render('Roles/Show', [
            'rol' => $rol
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $rol = Role::find($id);
        return Inertia::render('Roles/Edit', [
            'role' => $rol
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $id // exceptop el id porque es el mismo registro
        ]);
        $rol = Role::find($id);
        $rol->name = strtoupper($request->name);
        $rol->update();
        return to_route('admin.roles.index')
            ->with("message", "Rol actualizado exitosamente")
            ->with("icon", "success");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $rol = Role::find($id);
        $rol->delete();
        return to_route('admin.roles.index')
            ->with("message", "Rol eliminado exitosamente")
            ->with("icon", "success");
    }
}
