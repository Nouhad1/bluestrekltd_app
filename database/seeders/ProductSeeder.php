<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run()
    {
        DB::table('products')->insert([
            [
                'reference' => 'PRD001',
                'designation' => 'Batteur 10L',
                'prix_unitaire' => 1500,
                'prix_moyen' => 1400,
                'quantite_stock' => 10,
                'type' => 'Electroménager',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'reference' => 'PRD002',
                'designation' => 'Pétrin 25L',
                'prix_unitaire' => 3000,
                'prix_moyen' => 2900,
                'quantite_stock' => 5,
                'type' => 'Electroménager',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
