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
                'decrypt_key' => '47132061',
                'password' => Hash::make('47132061'),
                'role' => 'admin',
            ],
            //QYECO
            [
                'name' => 'JUDITH EVELING BARBARAN MENDEZ',
                'username' => 'JBARBARAN',
                'email' => 'informesqyeco04@qyeco.net',
                'decrypt_key' => '70811526',
                'password' => Hash::make('70811526'),
                'role' => 'agent',
            ],
            [
                'name' => 'Carolyn Aine Ayala Blas',
                'username' => 'CAYALA',
                'email' => 'informesqyeco03@qyeco.net',
                'decrypt_key' => '70811526',
                'password' => Hash::make('70811526'),
                'role' => 'agent',
            ],
            [
                'name' => 'Melissa Galvez Sumac',
                'username' => 'MGALVEZ',
                'email' => 'informesqyeco02@qyeco.net',
                'decrypt_key' => '75432443',
                'password' => Hash::make('75432443'),
                'role' => 'agent',
            ],
            [
                'name' => 'Haidy Elizabeth Castañeda Mattos',
                'username' => 'HCASTANEDA',
                'email' => 'informesqyeco@qyeco.net',
                'decrypt_key' => '75450745',
                'password' => Hash::make('75450745'),
                'role' => 'agent',
            ],
            [
                'name' => 'Lesly del Pilar Rivera Serrano',
                'username' => 'LRIVERA',
                'email' => 'lrivera@qyeco.net',
                'decrypt_key' => '70934848',
                'password' => Hash::make('70934848'),
                'role' => 'admin',
            ],


        ]);
    }
}
