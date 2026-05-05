<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Country;
use App\Models\Region;
use Illuminate\Support\Facades\Hash;

class TestAdminSeeder extends Seeder
{
    public function run()
    {
        // Récupérer les IDs
        $cameroun = Country::where('code', 'CMR')->first();
        $senegal = Country::where('code', 'SEN')->first();

        $littoral = Region::where('name', 'Littoral')->first();
        $dakar = Region::where('name', 'Dakar')->first();

        // Admin National Cameroun
        User::create([
            'name' => 'Jean Nkou',
            'email' => 'national.cm@uscia-afrique.org',
            'password' => Hash::make('Cm2025@'),
            'role' => 'national_admin',
            'country_id' => $cameroun->id ?? null,
            'is_active' => true,
            'created_by' => 1,
        ]);

        // Admin National Sénégal
        User::create([
            'name' => 'Fatou Diop',
            'email' => 'national.sn@uscia-afrique.org',
            'password' => Hash::make('Sn2025@'),
            'role' => 'national_admin',
            'country_id' => $senegal->id ?? null,
            'is_active' => true,
            'created_by' => 1,
        ]);

        // Admin Régional Littoral
        if ($littoral) {
            User::create([
                'name' => 'Paul Mbarga',
                'email' => 'littoral@uscia-afrique.org',
                'password' => Hash::make('Region2025@'),
                'role' => 'regional_admin',
                'country_id' => $cameroun->id ?? null,
                'region_id' => $littoral->id,
                'is_active' => true,
                'created_by' => 2,
            ]);
        }

        // Admin Régional Dakar
        if ($dakar) {
            User::create([
                'name' => 'Moussa Fall',
                'email' => 'dakar@uscia-afrique.org',
                'password' => Hash::make('Region2025@'),
                'role' => 'regional_admin',
                'country_id' => $senegal->id ?? null,
                'region_id' => $dakar->id,
                'is_active' => true,
                'created_by' => 3,
            ]);
        }

        $this->command->info('✅ Admins de test créés avec succès !');
    }
}
