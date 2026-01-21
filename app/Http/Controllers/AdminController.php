<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    public function index () 
    {
        $totalRoles = Role::count();
        $totalUsers = User::whereDoesntHave('roles', function ($query) {
            $query->where('name', 'SUPER ADMIN');
        })->count();
        // dd($totalUsers);
        return Inertia::render('Dashboard',[
            'totalRoles' => $totalRoles,
            'totalUsers' => $totalUsers
        ]);
    }
}
