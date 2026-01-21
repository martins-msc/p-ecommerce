<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // dd($request->filter);
        $search = $request->get('search');
        $query = User::whereDoesntHave('roles', function ($q) {
            $q->where('name', 'SUPER ADMIN');
        })->withTrashed();
        if ($search) {
            $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%');
        }

        $users = $query->with('roles')->paginate(5);
        return Inertia::render('Users/Index', [
            'users' => UserResource::collection($users),
            'filters' => $request->only(['search']), // <--- Envía el filtro de vuelta
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all()->skip(1);
        return Inertia::render('Users/Create', [
            'roles' => $roles
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'role' => 'required',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed'
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        $user->assignRole($request->role);

        return to_route('admin.users.index')
            ->with("message", "Usuario creado exitosamente")
            ->with("icon", "success");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);
        // dd(new UserResource($user));
        return Inertia::render('Users/Show', [
            'user' => new UserResource($user)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);
        $roles = Role::all();
        return Inertia::render('Users/Edit', [
            'user' => new UserResource($user),
            'roles' => $roles
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request, $id);
        $request->validate([
            'role' => 'required',
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed'
        ]);
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = bcrypt($request->password);
        }
        $user->save();
        $user->syncRoles($request->role);

        return to_route('admin.users.index')
            ->with("message", "Usuario actualizado exitosamente")
            ->with("icon", "success");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        $user->state = false;
        $user->save();
        $user->delete();

        return to_route('admin.users.index')
            ->with("message", "Usuario eliminado exitosamente")
            ->with('icon', 'success');
    }

    public function restore(string $id)
    {
        $user = User::withTrashed()->find($id);;
        $user->restore();
        $user->state = true;
        $user->save();

        return to_route('admin.users.index')
            ->with("message", "Usuario restaurado exitosamente")
            ->with('icon', 'success');
    }
}
