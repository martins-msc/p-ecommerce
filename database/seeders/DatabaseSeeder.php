<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Setting;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        Role::create(['name' => 'SUPER ADMIN']);
        Role::create(['name' => 'ADMINISTRADOR']);
        Role::create(['name' => 'VENDEDOR']);
        Role::create(['name' => 'CONTABILIDAD']);
        Role::create(['name' => 'OPERADOR']);
        Role::create(['name' => 'USUARIO']);
        Role::create(['name' => 'CLIENTE']);

        User::create([
            'name' => 'Martin sinka',
            'email' => 'admin@admin.com',
            'password' => bcrypt('12345678'),
        ])->assignRole('SUPER ADMIN');

        Setting::create([
            'system_name' => 'Martin SRL',
            'description' => 'Tienda virtual de productos variados',
            'branch_Store' => 'Matriz',
            'address' => 'Av Siempre Viva 123',
            'phone_number' => '32165487',
            'email' => 'marrtin@gmail.com',
            'logo' => 'logos/oAntdL85mfpkWVZbPA285fALaL0BrbiODLko4aEL.png',
            'image_login' => 'login_images/7Iw8CHrgAUkcVvju8NtVa7k60Ky9VXUnrov1VQeS.jpg',
            'currency' => 'BOB'
        ]);

        Category::factory(15)->create();
        Product::factory(50)->create();
    }
}
