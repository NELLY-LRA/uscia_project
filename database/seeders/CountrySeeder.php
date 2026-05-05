<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;

class CountrySeeder extends Seeder
{
    public function run()
    {
        $countries = [
            ['name' => 'Cameroun', 'code' => 'CMR'],
            ['name' => 'Sénégal', 'code' => 'SEN'],
            ['name' => "Côte d'Ivoire", 'code' => 'CIV'],
            ['name' => 'République Démocratique du Congo', 'code' => 'COD'],
            ['name' => 'Gabon', 'code' => 'GAB'],
            ['name' => 'Congo-Brazzaville', 'code' => 'COG'],
            ['name' => 'Togo', 'code' => 'TGO'],
            ['name' => 'Bénin', 'code' => 'BEN'],
            ['name' => 'Burkina Faso', 'code' => 'BFA'],
            ['name' => 'Mali', 'code' => 'MLI'],
            ['name' => 'Niger', 'code' => 'NER'],
            ['name' => 'Tchad', 'code' => 'TCD'],
            ['name' => 'Centrafrique', 'code' => 'CAF'],
            ['name' => 'Guinée', 'code' => 'GIN'],
            ['name' => 'Guinée-Bissau', 'code' => 'GNB'],
            ['name' => 'Mauritanie', 'code' => 'MRT'],
            ['name' => 'Nigeria', 'code' => 'NGA'],
            ['name' => 'Ghana', 'code' => 'GHA'],
            ['name' => 'Rwanda', 'code' => 'RWA'],
            ['name' => 'Burundi', 'code' => 'BDI'],
            ['name' => 'Ouganda', 'code' => 'UGA'],
            ['name' => 'Kenya', 'code' => 'KEN'],
            ['name' => 'Tanzanie', 'code' => 'TZA'],
            ['name' => 'Angola', 'code' => 'AGO'],
            ['name' => 'Mozambique', 'code' => 'MOZ'],
            ['name' => 'Zambie', 'code' => 'ZMB'],
            ['name' => 'Zimbabwe', 'code' => 'ZWE'],
            ['name' => 'Namibie', 'code' => 'NAM'],
            ['name' => 'Botswana', 'code' => 'BWA'],  // ← Une seule fois !
            ['name' => 'Afrique du Sud', 'code' => 'ZAF'],
            ['name' => 'Madagascar', 'code' => 'MDG'],
            ['name' => 'Maurice', 'code' => 'MUS'],
            ['name' => 'Comores', 'code' => 'COM'],
            ['name' => 'Seychelles', 'code' => 'SYC'],
            ['name' => 'Cap-Vert', 'code' => 'CPV'],
            ['name' => 'Sao Tomé-et-Principe', 'code' => 'STP'],
            ['name' => 'Guinée équatoriale', 'code' => 'GNQ'],
            ['name' => 'Djibouti', 'code' => 'DJI'],
            ['name' => 'Soudan', 'code' => 'SDN'],
            ['name' => 'Soudan du Sud', 'code' => 'SSD'],
            ['name' => 'Érythrée', 'code' => 'ERI'],
            ['name' => 'Éthiopie', 'code' => 'ETH'],
            ['name' => 'Somalie', 'code' => 'SOM'],
            ['name' => 'Libye', 'code' => 'LBY'],
            ['name' => 'Tunisie', 'code' => 'TUN'],
            ['name' => 'Algérie', 'code' => 'DZA'],
            ['name' => 'Maroc', 'code' => 'MAR'],
            ['name' => 'Égypte', 'code' => 'EGY'],
            ['name' => 'Sahara Occidental', 'code' => 'ESH'],
            ['name' => 'Liberia', 'code' => 'LBR'],
            ['name' => 'Sierra Leone', 'code' => 'SLE'],
            ['name' => 'Gambie', 'code' => 'GMB'],
            ['name' => 'Malawi', 'code' => 'MWI'],
            ['name' => 'Eswatini', 'code' => 'SWZ'],
            ['name' => 'Lesotho', 'code' => 'LSO'],
        ];

        foreach ($countries as $country) {
            // Utilise firstOrCreate pour éviter les doublons
            Country::firstOrCreate(
                ['code' => $country['code']],  // Cherche par code
                ['name' => $country['name']]   // Si pas trouvé, crée avec ce nom
            );
        }

        $this->command->info('✅ Pays ajoutés avec succès !');
    }
}
