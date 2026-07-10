<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Wilayah;

class WilayahSeeder extends Seeder
{
    public function run(): void
    {
        Wilayah::truncate();

        Wilayah::insert([

            [
                'provinsi'=>'Kalimantan Barat',
                'kabupaten'=>'Kota Pontianak',
                'kecamatan'=>'Pontianak Selatan',
                'kelurahan'=>'Benua Melayu Darat',
                'rt'=>'001',
                'rw'=>'002',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],

            [
                'provinsi'=>'Kalimantan Barat',
                'kabupaten'=>'Kota Pontianak',
                'kecamatan'=>'Pontianak Selatan',
                'kelurahan'=>'Akcaya',
                'rt'=>'002',
                'rw'=>'001',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],

            [
                'provinsi'=>'Kalimantan Barat',
                'kabupaten'=>'Kota Pontianak',
                'kecamatan'=>'Pontianak Kota',
                'kelurahan'=>'Mariana',
                'rt'=>'003',
                'rw'=>'001',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],

            [
                'provinsi'=>'Kalimantan Barat',
                'kabupaten'=>'Kota Pontianak',
                'kecamatan'=>'Pontianak Barat',
                'kelurahan'=>'Pal Lima',
                'rt'=>'001',
                'rw'=>'004',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],

            [
                'provinsi'=>'Kalimantan Barat',
                'kabupaten'=>'Kota Pontianak',
                'kecamatan'=>'Pontianak Utara',
                'kelurahan'=>'Siantan Hulu',
                'rt'=>'002',
                'rw'=>'003',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],

            [
                'provinsi'=>'Kalimantan Barat',
                'kabupaten'=>'Kota Singkawang',
                'kecamatan'=>'Singkawang Tengah',
                'kelurahan'=>'Condong',
                'rt'=>'002',
                'rw'=>'005',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],

            [
                'provinsi'=>'Kalimantan Barat',
                'kabupaten'=>'Kota Singkawang',
                'kecamatan'=>'Singkawang Barat',
                'kelurahan'=>'Melayu',
                'rt'=>'003',
                'rw'=>'001',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],

            [
                'provinsi'=>'Kalimantan Barat',
                'kabupaten'=>'Kota Singkawang',
                'kecamatan'=>'Singkawang Timur',
                'kelurahan'=>'Mayasofa',
                'rt'=>'001',
                'rw'=>'002',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],

            [
                'provinsi'=>'Kalimantan Barat',
                'kabupaten'=>'Kabupaten Kubu Raya',
                'kecamatan'=>'Sungai Raya',
                'kelurahan'=>'Arang Limbung',
                'rt'=>'001',
                'rw'=>'004',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],

            [
                'provinsi'=>'Kalimantan Barat',
                'kabupaten'=>'Kabupaten Kubu Raya',
                'kecamatan'=>'Sungai Raya',
                'kelurahan'=>'Limbung',
                'rt'=>'002',
                'rw'=>'003',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],

            [
                'provinsi'=>'Kalimantan Barat',
                'kabupaten'=>'Kabupaten Mempawah',
                'kecamatan'=>'Mempawah Hilir',
                'kelurahan'=>'Tengah',
                'rt'=>'001',
                'rw'=>'001',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],

            [
                'provinsi'=>'Kalimantan Barat',
                'kabupaten'=>'Kabupaten Mempawah',
                'kecamatan'=>'Mempawah Timur',
                'kelurahan'=>'Antibar',
                'rt'=>'002',
                'rw'=>'002',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],

            [
                'provinsi'=>'Kalimantan Barat',
                'kabupaten'=>'Kabupaten Sambas',
                'kecamatan'=>'Sambas',
                'kelurahan'=>'Durian',
                'rt'=>'003',
                'rw'=>'001',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],

            [
                'provinsi'=>'Kalimantan Barat',
                'kabupaten'=>'Kabupaten Ketapang',
                'kecamatan'=>'Delta Pawan',
                'kelurahan'=>'Sukaharja',
                'rt'=>'002',
                'rw'=>'004',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],

            [
                'provinsi'=>'Kalimantan Barat',
                'kabupaten'=>'Kabupaten Sanggau',
                'kecamatan'=>'Kapuas',
                'kelurahan'=>'Ilir Kota',
                'rt'=>'001',
                'rw'=>'003',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],

        ]);
    }
}