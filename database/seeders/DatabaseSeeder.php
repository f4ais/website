<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            AidProgramSeeder::class,
            CitizenSeeder::class,
            SurveySeeder::class,
            RecipientSeeder::class,
        ]);
    }
}
