<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('regiones')->insert([
            ['nombre' => 'America del sur'],
            ['nombre' => 'America central'],
            ['nombre' => 'Caribe y Mexico'],
            ['nombre' => 'America del norte'],
            ['nombre' => 'Europa occidental'],
            ['nombre' => 'Europa del este'],
            ['nombre' => 'Asia'],
            ['nombre' => 'Oceania'],
        ]);
    }
}
