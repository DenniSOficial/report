<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class TypeReportsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('type_reports')->insert([
            
            [
                'description' => 'INFORME COMPARATIVO',
            ],
            [
                'description' => 'INFORME DE MONITOREO AMBIENTAL',
            ],
            [
                'description' => 'INFORME DE AVANCE/CUMPLIMIENTO AMBIENTAL',
            ],
            [
                'description' => 'INFORME ANUAL DE GESTIÓN AMBIENTAL - ELECTRICIDAD',
            ],
            [
                'description' => 'INFORME ANUAL DE GESTIÓN AMBIENTAL - HIDROCARBUROS',
            ],
        ]);
    }
}
