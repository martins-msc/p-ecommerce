<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use Inertia\Inertia;

class SettingController extends Controller
{
    public function index() 
    {
        // Using currency api 
        $response = Http::get('https://api.hilariweb.com/divisas');
        $data_currency = $response->json();
        // dd($data_currency);
        return Inertia::render('Setting/Index', [
            'currency' => $data_currency
        ]);

        
    }
}
