<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {

        User::create([
            'name' => 'Luis Fax',
            'phone' => '3511159550',
            'email' => 'luisfaax@gmail.com',
            'profile' => 'Administrador',
            'status' => 'ACTIVE',
            'password' => bcrypt('123'),
        ]);


        User::create([
            'name' => 'Liz Conde',
            'phone' => '3511159550',
            'email' => 'torricokaren12@gmail.com',
            'profile' => 'Administrador',
            'status' => 'ACTIVE',
            'password' => bcrypt('Coraline1612.'),
        ]);


    }
}
