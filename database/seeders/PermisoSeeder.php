<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permission;
use Spatie\Permission\Models\Role as ModelsRole;

// use Spatie\Permission\Models\Role;

class PermisoSeeder extends Seeder
{
    public function run()
    {
      Permission::create([
        'name'=>'Administrador',
        // 'descripcion' => '',
        'guard_name'=>'web'
      ]);

      Permission::create([
        'name'=>'Ver_productos',
        // 'descripcion' => '',
        'guard_name'=>'web'
      ]);

      Permission::create([
        'name'=>'Realizar_Venta',
        // 'descripcion' => '',
        'guard_name'=>'web'
      ]);

      Permission::create([
        'name'=>'Ver_usuarios',
        // 'descripcion' => '',
        'guard_name'=>'web'
      ]);

      Permission::create([
        'name'=>'Eliminar_Venta',
        // 'descripcion' => 'Eliminar el campo que se seleccione',
        'guard_name'=>'web'
      ]);
      
      Permission::create([
        'name'=>'Ver_categorias',
        // 'descripcion' => 'Se mostrarán todas las categorias',
        'guard_name'=>'web'
      ]);
    }
}