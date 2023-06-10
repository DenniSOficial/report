<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            
            //Admin
            [
                'name' => 'Omar Landa',
                'username' => 'olanda',
                'email' => 'programador@sagperu.com',
                'password' => Hash::make('47132061'),
                'role' => 'admin',
                'status' => 'active',
            ],

        ]);
    }
}
