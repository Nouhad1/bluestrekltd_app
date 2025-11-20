<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class CategoriesSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();
        DB::table('catagories')->insert([
            ['id'=>1, 'catagory_name'=>'Fontine à Chocolat', 'created_at'=>$now, 'updated_at'=>$now, 'image'=>'1762271244_chocolat fontaine.png'],
            ['id'=>3, 'catagory_name'=>'Machine à café', 'created_at'=>$now, 'updated_at'=>$now, 'image'=>'2groupesN.jpg'],
            ['id'=>4, 'catagory_name'=>'Comptoir', 'created_at'=>$now, 'updated_at'=>$now, 'image'=>'1762270151_4l4.jpg'],
            ['id'=>5, 'catagory_name'=>'Rideau Lanière', 'created_at'=>$now, 'updated_at'=>$now, 'image'=>'lanière.png'],
            ['id'=>6, 'catagory_name'=>'Armoire', 'created_at'=>$now, 'updated_at'=>$now, 'image'=>'1762249853_tekli34.jpg'],
            ['id'=>7, 'catagory_name'=>'Four à pizza', 'created_at'=>$now, 'updated_at'=>$now, 'image'=>'1762767417_WhatsApp Image 2025-09-01 at 09.35.52-Photoroom.png'],
            ['id'=>8, 'catagory_name'=>'Friteuse', 'created_at'=>$now, 'updated_at'=>$now, 'image'=>''],
            ['id'=>9, 'catagory_name'=>'Réfrigérateur commercial', 'created_at'=>$now, 'updated_at'=>$now, 'image'=>'CL380SDC.png'],
            ['id'=>11, 'catagory_name'=>'Pétrin', 'created_at'=>$now, 'updated_at'=>$now, 'image'=>'petrin.png'],
            ['id'=>12, 'catagory_name'=>'Batteur', 'created_at'=>$now, 'updated_at'=>$now, 'image'=>'batteur.png'],
            ['id'=>13, 'catagory_name'=>'Blender', 'created_at'=>$now, 'updated_at'=>$now, 'image'=>'1762270921_Adobe Express - file (1).png'],
            ['id'=>14, 'catagory_name'=>'Congélateur et Conservateur', 'created_at'=>$now, 'updated_at'=>$now, 'image'=>'CL 400 DAC.jpg'],
            ['id'=>17, 'catagory_name'=>'Back bar', 'created_at'=>$now, 'updated_at'=>$now, 'image'=>'CL 350 BCKB SL.png'],
            ['id'=>21, 'catagory_name'=>'Moulin', 'created_at'=>$now, 'updated_at'=>$now, 'image'=>''],
            ['id'=>22, 'catagory_name'=>'Gaufrier', 'created_at'=>$now, 'updated_at'=>$now, 'image'=>''],
            ['id'=>29, 'catagory_name'=>'Accessoires de fixation', 'created_at'=>$now, 'updated_at'=>$now, 'image'=>'accessories.png'],
        ]);
    }
}
