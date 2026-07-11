<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            ['name' => 'Administrator SIPBANSOS', 'email' => 'admin@sipbansos.test', 'role' => 'admin', 'wilayah' => null],
            ['name' => 'Ketua RT/RW Mawar', 'email' => 'rtrw@sipbansos.test', 'role' => 'rtrw', 'wilayah' => 'RT 001 / RW 002'],
            ['name' => 'Surveyor Lapangan', 'email' => 'surveyor@sipbansos.test', 'role' => 'surveyor', 'wilayah' => null],
            ['name' => 'Petugas Penyalur', 'email' => 'penyalur@sipbansos.test', 'role' => 'penyalur', 'wilayah' => null],
            ['name' => 'Ketua RT/RW Melati', 'email' => 'rtrw2@sipbansos.test', 'role' => 'rtrw', 'wilayah' => 'RT 003 / RW 002'],
        ];

        foreach ($users as $user) {
            User::updateOrCreate(['email' => $user['email']], $user + [
                'password' => Hash::make('password'),
                'is_active' => true,
            ]);
        }
    }
}
