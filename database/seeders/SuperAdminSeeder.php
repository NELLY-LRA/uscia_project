<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'JACKY JACKSON NOUDJO NOUMEGNI',  // Un seul champ name
            'email' => 'super.admin@uscia-afrique.org',
            'password' => Hash::make('Admin@2025'),
            'role' => 'super_admin',
            'is_active' => true,
            'created_by' => null,
        ]);

        $this->command->info('✅ Super Admin créé avec succès !');
        $this->command->warn('📧 Email: super.admin@uscia-afrique.org');
        $this->command->warn('🔑 Mot de passe: Admin@2025');
    }
}
