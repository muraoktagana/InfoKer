<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Jurusan;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name'=>'admin',
            'email'=>'admin@gmail.com',
            'password'=>bcrypt('admin'),
            'level'=>'admin',
        ]);

        Jurusan::create([
            'jurusan'=>'Teknik Jaringan',
        ]);
        Jurusan::create([
            'jurusan'=>'Rekayasa Perangkat Lunak',
        ]);
        Jurusan::create([
            'jurusan'=>'Multi Media',
        ]);
    }
}
