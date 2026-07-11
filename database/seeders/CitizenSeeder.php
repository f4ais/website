<?php

namespace Database\Seeders;

use App\Models\Citizen;
use App\Models\User;
use Illuminate\Database\Seeder;

class CitizenSeeder extends Seeder
{
    public function run(): void
    {
        $rtrw1 = User::where('email', 'rtrw@sipbansos.test')->firstOrFail();
        $rtrw2 = User::where('email', 'rtrw2@sipbansos.test')->firstOrFail();

        $citizens = [
            ['creator' => $rtrw1, 'nik' => '6101010101800001', 'kk' => '6101010101010001', 'name' => 'Siti Aminah', 'gender' => 'P', 'birth' => '1980-01-01', 'rt' => '001', 'rw' => '002', 'wilayah' => $rtrw1->wilayah, 'income' => 850000, 'dependents' => 5, 'house' => 'sangat_tidak_layak', 'elderly' => true, 'disability' => false, 'single' => true, 'status' => 'verified'],
            ['creator' => $rtrw1, 'nik' => '6101010201750002', 'kk' => '6101010202020002', 'name' => 'Budi Santoso', 'gender' => 'L', 'birth' => '1975-02-02', 'rt' => '001', 'rw' => '002', 'wilayah' => $rtrw1->wilayah, 'income' => 1200000, 'dependents' => 4, 'house' => 'tidak_layak', 'elderly' => false, 'disability' => true, 'single' => false, 'status' => 'verified'],
            ['creator' => $rtrw1, 'nik' => '6101010301900003', 'kk' => '6101010303030003', 'name' => 'Nurhayati', 'gender' => 'P', 'birth' => '1990-03-03', 'rt' => '001', 'rw' => '002', 'wilayah' => $rtrw1->wilayah, 'income' => 1750000, 'dependents' => 3, 'house' => 'cukup', 'elderly' => true, 'disability' => false, 'single' => false, 'status' => 'assigned'],
            ['creator' => $rtrw1, 'nik' => '6101010401850004', 'kk' => '6101010404040004', 'name' => 'Ahmad Fauzi', 'gender' => 'L', 'birth' => '1985-04-04', 'rt' => '001', 'rw' => '002', 'wilayah' => $rtrw1->wilayah, 'income' => 2300000, 'dependents' => 2, 'house' => 'layak', 'elderly' => false, 'disability' => false, 'single' => false, 'status' => 'pending'],
            ['creator' => $rtrw2, 'nik' => '6101010501700005', 'kk' => '6101010505050005', 'name' => 'Mariam', 'gender' => 'P', 'birth' => '1970-05-05', 'rt' => '003', 'rw' => '002', 'wilayah' => $rtrw2->wilayah, 'income' => 900000, 'dependents' => 6, 'house' => 'tidak_layak', 'elderly' => true, 'disability' => true, 'single' => true, 'status' => 'verified'],
            ['creator' => $rtrw2, 'nik' => '6101010601880006', 'kk' => '6101010606060006', 'name' => 'Rudi Hartono', 'gender' => 'L', 'birth' => '1988-06-06', 'rt' => '003', 'rw' => '002', 'wilayah' => $rtrw2->wilayah, 'income' => 3000000, 'dependents' => 1, 'house' => 'layak', 'elderly' => false, 'disability' => false, 'single' => false, 'status' => 'rejected'],
        ];

        foreach ($citizens as $item) {
            Citizen::updateOrCreate(['nik' => $item['nik']], [
                'created_by' => $item['creator']->id,
                'family_card_number' => $item['kk'],
                'name' => $item['name'],
                'gender' => $item['gender'],
                'birth_date' => $item['birth'],
                'address' => 'Jalan Sejahtera, '.$item['wilayah'],
                'rt' => $item['rt'],
                'rw' => $item['rw'],
                'wilayah' => $item['wilayah'],
                'village' => 'Desa Harapan',
                'district' => 'Kecamatan Sejahtera',
                'phone' => '0812'.substr($item['nik'], -8),
                'income' => $item['income'],
                'dependents' => $item['dependents'],
                'house_condition' => $item['house'],
                'has_elderly' => $item['elderly'],
                'has_disability' => $item['disability'],
                'is_single_parent' => $item['single'],
                'verification_status' => $item['status'],
            ]);
        }
    }
}
