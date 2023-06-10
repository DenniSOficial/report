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
                'document' => '47132061',
                'name' => 'OMAR DENNIS',
                'lastname' => 'LANDA',
                'lastname2' => 'AMAO',
                'email' => 'programador@sagperu.com',
                'telephone' => '961780938',
                'created_user_id' => 1
            ],

        ]);
    }
}
