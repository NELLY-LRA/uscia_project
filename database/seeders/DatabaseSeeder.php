<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            CountrySeeder::class,
            RegionSeeder::class,
            GradeSeeder::class,
            SuperAdminSeeder::class,
            TestAdminSeeder::class,
        ]);

        $this->command->info('🎉 Tous les seeders ont été exécutés avec succès !');
    }
}
