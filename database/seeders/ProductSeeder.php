<?php

namespace Database\Seeders;

use App\Models\product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        product::create([
            'CategoryId' => 1,
            'Nama'=>'Air Jordan',
            'Harga'=>3000000,
            'Jumlah'=>10,
            'Photo'=>fake()->image()
        ]);

        product::create([
            'CategoryId' => 2,
            'Nama'=>'Airism Uniqlo',
            'Harga'=>300000,
            'Jumlah'=>10,
            'Photo'=>fake()->image()
        ]);
    }
}
