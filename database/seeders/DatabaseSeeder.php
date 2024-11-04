<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        DB::table('roles')->insert([
            'rol' => 'Administrador',
            'descripcion' => 'Rol con el priviegio más alto del sistema.',
            'created_at' => now()
        ]);

        DB::table('roles')->insert([
            'rol' => 'Monitoreo',
            'descripcion' => 'Este usuario puede consultar reportes, visualizar dashboards.',
            'created_at' => now()
        ]);

        DB::table('roles')->insert([
            'rol' => 'Estandar',
            'descripcion' => 'El usuario estandar unicamente puede crear facturas y registrar pagos.',
            'created_at' => now()
        ]);

        User::create([
            'name' => 'Usuario Administrador',
            'email' => 'administrador@hotmail.com',
            'password' => Hash::make('123'),
            'rol_type' => '1'
        ]);

        User::create([
            'name' => 'Usuario Monitoreo',
            'email' => 'monitoreo@hotmail.com',
            'password' => Hash::make('123'),
            'rol_type' => '1'
        ]);

        User::create([
            'name' => 'Usuario Estandar',
            'email' => 'estandar@hotmail.com',
            'password' => Hash::make('123'),
            'rol_type' => '1'
        ]);
    }
}
