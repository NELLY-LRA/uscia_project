<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          User::create([
        'last_name' => ' NOUDJO NOUMEGNI',
        'first_name' => 'JACKY JACKSON',
        'phone' => '',
        'grade' => 'GENERAL COMMANDER OF CHAPLAINCY',
        'gender' => 'male',
        'date_of_birth' => '1985-01-21',
        'address' => 'Cameroon',
        'email' => 'documentsuscia@gmail.com',
        'nationality' => 'Cameroonian',
        'educational_level' => 'WORLD HUMANITARIAN INT. POLICE',
        'blood_group' => 'A+',
        'occupation' => 'COMMANDER GENERAL OF AFRICA',
        'passport' => 'AA133984',
        'cni_number' => '118125281',
        'organization' => 'USCIA',
        'citizenship_id' => 'CM B-0205',
        'nearest_police_station' => 'Central Commissariat',
        'cv' => '',
        'letter_of_recommendation' => '',
        'criminal_record' => '',
        'has_been_convicted' => false,
        'is_pastor' => true,
        'role' => 'super-admin',
        'password' => Hash::make('1234567890'),
    ]);

    }
}
