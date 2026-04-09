<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Reactivo;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Usuario administrador
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@lab.com',
            'username' => 'admin',
            'password' => Hash::make('admin123'),
            'invitation_code' => '123456789',
        ]);

        // Reactivos de prueba
        Reactivo::create([
            'nombre' => 'Ácido Sulfúrico',
            'formula_quimica' => 'H2SO4',
            'cantidad' => 500,
            'unidad_medida' => 'ml',
            'fecha_caducidad' => '2025-12-31',
            'proveedor' => 'Sigma-Aldrich',
            'ubicacion' => 'Estante A1',
            'lote' => 'LOT2024-001',
            'qr_code' => 'REACTIVO_' . uniqid(),
            'registrado_por' => 1,
        ]);

        Reactivo::create([
            'nombre' => 'Etanol',
            'formula_quimica' => 'C2H5OH',
            'cantidad' => 1000,
            'unidad_medida' => 'ml',
            'fecha_caducidad' => '2024-12-31',
            'proveedor' => 'Merck',
            'ubicacion' => 'Estante B2',
            'lote' => 'LOT2024-002',
            'qr_code' => 'REACTIVO_' . uniqid(),
            'registrado_por' => 1,
        ]);
    }
}