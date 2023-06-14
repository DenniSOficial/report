<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class DocumentStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('document_statuses')->insert([
            
            [
                'name' => 'Nuevo',
            ],
            [
                'name' => 'Observado',
            ],
            [
                'name' => 'Revisado',
            ],

        ]);
    }
}
