<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Jalankan WilayahSeeder
        $this->call([
            WilayahSeeder::class,
        ]);

        // Tambahkan role admin
        DB::table('roles')->insert([
            [
                'id' => 1,
                'name' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Tambahkan akun admin
        User::create([
            'name' => 'Admin Bantuan',
            'email' => 'rizky@gmail.com',
            'password' => Hash::make('americano123'),
            'role_id' => 1,
        ]);
    }
}