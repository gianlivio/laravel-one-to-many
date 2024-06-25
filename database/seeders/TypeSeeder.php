<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        {
            DB::table('types')->insert([
                ['name' => 'Musica', 'description' => 'Progetti relativi alla matematica'],
                ['name' => 'Agricoltura', 'description' => 'Progetti relativi alla fisica'],
                ['name' => 'Informatica', 'description' => 'Progetti relativi all\'informatica'],
            ]);
        }
    }
}
