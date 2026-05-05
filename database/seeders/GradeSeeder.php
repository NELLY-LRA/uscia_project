<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Grade;

class GradeSeeder extends Seeder
{
    public function run()
    {
        $grades = [
            ['name' => 'Officier', 'abbreviation' => 'OFF', 'level' => 1],
            ['name' => 'Lieutenant', 'abbreviation' => 'LT', 'level' => 2],
            ['name' => 'Lieutenant Major', 'abbreviation' => 'LTM', 'level' => 3],
            ['name' => 'Capitaine', 'abbreviation' => 'CAP', 'level' => 4],
            ['name' => 'Colonnel', 'abbreviation' => 'CL', 'level' => 5],
            ['name' => 'Commandant', 'abbreviation' => 'CDT', 'level' => 6],
            ['name' => 'Général', 'abbreviation' => 'GEN', 'level' => 7],
        ];

        foreach ($grades as $grade) {
            Grade::create($grade);
        }

        $this->command->info('✅ Grades ajoutés avec succès !');
    }
}
