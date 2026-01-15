<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class SettingController extends Controller
{
    public function index() 
    {
        $setting = Setting::first();
        // Using currency api 
        $response = Http::get('https://api.hilariweb.com/divisas');
        $data_currency = $response->json();
        return Inertia::render('Setting/Index', [
            'currency' => $data_currency,
            'setting' => $setting
        ]);
    }

    public function store(Request $request)
    {
        $setting = Setting::first();

        // return response()->json($request->all());
        $rules = [
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'branch' => 'required|string|max:255',
            'address' => 'required|string',
            'phone' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'currency' => 'required|string|max:10',
            'website' => 'nullable|url|max:255',
        ];

        if(!$setting) {
            $rules['logo'] = 'required|image|mimes:jpeg,png,jpg,gif,svg';
            $rules['image_login'] = 'required|image|mimes:jpeg,png,jpg,gif,svg';
        }else{
            $rules['logo'] = 'nullable|image|mimes:jpeg,png,jpg,gif,svg';
            $rules['image_login'] = 'nullable|image|mimes:jpeg,png,jpg,gif,svg';
        }
        $request->validate($rules);

        if(!$setting) {
            $setting = new Setting();
        }

        $setting->system_name = $request->name;
        $setting->description = $request->description;
        $setting->branch_store = $request->branch;
        $setting->address = $request->address;
        $setting->phone_number = $request->phone;
        $setting->email = $request->email;
        $setting->currency = $request->currency;
        $setting->web_site = $request->website;

        // if exists a file it will be deleted
        if($request->hasFile('logo')) {
            if($setting->logo && Storage::disk('public')->exists($setting->logo)) {
                Storage::disk('public')->delete($setting->logo);
            }
            $setting->logo = $request->file('logo')->store('logos', 'public');
        }
        if($request->hasFile('image_login')) {
            if($setting->image_login && Storage::disk('public')->exists($setting->image_login)) {
                Storage::disk('public')->delete($setting->image_login);
            }
            $setting->image_login = $request->file('image_login')->store('login_images', 'public');
        }

        $setting->save();
    }
}
