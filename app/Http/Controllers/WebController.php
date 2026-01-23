<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Setting;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

class WebController extends Controller
{
    public function index()
    {
        $setting = Setting::first();
        $products = Product::all();
        return Inertia::render('Web/Index', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'setting' => $setting,
            'products' => $products
        ]);
    }
}
