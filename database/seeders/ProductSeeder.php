<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Product::create([
        'name' => 'LARAVEL Y LIVEWIRE',
        'cost' => 200,
        'price' => 350,
        'bardcode' => '75010065987',
        'stock' => 1000,
        'alerts' => 10,
        'category_id' => 1,
        'image' => 'curso.png'
      ]);

      Product::create([
        'name' => 'RUNNING NIKE',
        'cost' => 600,
        'price' => 1500,
        'bardcode' => '75010065987',
        'stock' => 1000,
        'alerts' => 10,
        'category_id' => 1,
        'image' => 'curso.png'
      ]);

      Product::create([
        'name' => 'IPHONE 11',
        'cost' => 900,
        'price' => 1400,
        'bardcode' => '75010065987',
        'stock' => 1000,
        'alerts' => 10,
        'category_id' => 1,
        'image' => 'curso.png'
      ]);

      Product::create([
        'name' => 'PC GAMMER',
        'cost' => 790,
        'price' => 350,
        'bardcode' => '75010065987',
        'stock' => 1000,
        'alerts' => 10,
        'category_id' => 1,
        'image' => 'curso.png'
      ]);
    }
}
