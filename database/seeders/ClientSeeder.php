<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientSeeder extends Seeder
{
    public function run()
    {
        DB::table('clients')->insert([
            [
                'name' => 'Hotel Royal',
                'email' => 'contact@hotelroyal.com',
                'phone' => '0612345678',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Restaurant Le Gourmet',
                'email' => 'info@legourmet.com',
                'phone' => '0678123456',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
