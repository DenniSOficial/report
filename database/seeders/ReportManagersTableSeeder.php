<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class ReportManagersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('report_managers')->insert([
            
            [
                'type_document' => 'DNI',
                'document' => '70811526',
                'name' => 'JUDITH EVELING',
                'lastname' => 'BARBARAN',
                'lastname2' => 'MENDEZ',
                'email' => 'informesqyeco04@qyeco.net',
                'created_user_id' => 1
            ],
            [
                'type_document' => 'DNI',
                'document' => '72132194',
                'name' => 'Carolyn Aine',
                'lastname' => 'Ayala',
                'lastname2' => 'Blas',
                'email' => 'informesqyeco03@qyeco.net',
                'created_user_id' => 1
            ],
            [
                'type_document' => 'DNI',
                'document' => '75432443',
                'name' => 'Melissa',
                'lastname' => 'Galvez',
                'lastname2' => 'Sumac',
                'email' => 'informesqyeco02@qyeco.net',
                'created_user_id' => 1
            ],
            [
                'type_document' => 'DNI',
                'document' => '75450745',
                'name' => 'Haidy Elizabeth',
                'lastname' => 'Castañeda',
                'lastname2' => 'Mattos',
                'email' => 'informesqyeco@qyeco.net',
                'created_user_id' => 1
            ],
            [
                'type_document' => 'DNI',
                'document' => '70934848',
                'name' => 'Lesly del Pilar',
                'lastname' => 'Rivera',
                'lastname2' => 'Serrano',
                'email' => 'lrivera@qyeco.net',
                'created_user_id' => 1
            ],

        ]);
    }
}
