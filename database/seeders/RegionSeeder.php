<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Region;
use App\Models\Country;


class RegionSeeder extends Seeder
{
    public function run()
    {
        // Régions du Cameroun
        $cameroun = Country::where('code', 'CMR')->first();
        if ($cameroun) {
            $regionsCameroun = [
                'Adamoua', 'Centre', 'Est', 'Extrême-Nord', 'Littoral',
                'Nord', 'Nord-Ouest', 'Ouest', 'Sud', 'Sud-Ouest'
            ];

            foreach ($regionsCameroun as $region) {
                Region::create([
                    'name' => $region,
                    'country_id' => $cameroun->id
                ]);
            }
        }

        // Régions du Sénégal
        $senegal = Country::where('code', 'SEN')->first();
        if ($senegal) {
            $regionsSenegal = [
                'Dakar', 'Diourbel', 'Fatick', 'Kaffrine', 'Kaolack',
                'Kédougou', 'Kolda', 'Louga', 'Matam', 'Saint-Louis',
                'Sédhiou', 'Tambacounda', 'Thiès', 'Ziguinchor'
            ];

            foreach ($regionsSenegal as $region) {
                Region::create([
                    'name' => $region,
                    'country_id' => $senegal->id
                ]);
            }
        }

        // Régions de Côte d'Ivoire
        $civ = Country::where('code', 'CIV')->first();
        if ($civ) {
            $regionsCiv = [
                'Abidjan', 'Bas-Sassandra', 'Comoé', 'Denguélé', 'Gôh-Djiboua',
                'Lacs', 'Lagunes', 'Montagnes', 'Sassandra-Marahoué',
                'Savanes', 'Vallée du Bandama', 'Woroba', 'Yamoussoukro', 'Zanzan'
            ];

            foreach ($regionsCiv as $region) {
                Region::create([
                    'name' => $region,
                    'country_id' => $civ->id
                ]);
            }
        }

        // Régions du Gabon
        $gabon = Country::where('code', 'GAB')->first();
        if ($gabon) {
            $regionsGabon = [
                'Estuaire', 'Haut-Ogooué', 'Moyen-Ogooué', 'Ngounié',
                'Nyanga', 'Ogooué-Ivindo', 'Ogooué-Lolo', 'Ogooué-Maritime', 'Woleu-Ntem'
            ];

            foreach ($regionsGabon as $region) {
                Region::create([
                    'name' => $region,
                    'country_id' => $gabon->id
                ]);
            }
        }

        // Régions du Togo
        $togo = Country::where('code', 'TGO')->first();
        if ($togo) {
            $regionsTogo = ['Maritime', 'Plateaux', 'Centrale', 'Kara', 'Savanes'];

            foreach ($regionsTogo as $region) {
                Region::create([
                    'name' => $region,
                    'country_id' => $togo->id
                ]);
            }
        }

        // Régions du Bénin
        $benin = Country::where('code', 'BEN')->first();
        if ($benin) {
            $regionsBenin = [
                'Alibori', 'Atacora', 'Atlantique', 'Borgou', 'Collines',
                'Couffo', 'Donga', 'Littoral', 'Mono', 'Ouémé', 'Plateau', 'Zou'
            ];

            foreach ($regionsBenin as $region) {
                Region::create([
                    'name' => $region,
                    'country_id' => $benin->id
                ]);
            }
        }

        $this->command->info('✅ Régions ajoutées avec succès !');
    }
}
