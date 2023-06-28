<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use Spatie\Permission\Models\Role as ModelsRole;

// use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    
    public function run()
    {
      Role::create([
        'name'=>'Administrador',
        'guard_name'=>'web'
      ]);
    }
}