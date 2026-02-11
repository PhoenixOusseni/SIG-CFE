<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PersonnelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('personnels')->insert([
            'code' => 'P001',
            'nom' => 'Personnel 001',
            'prenom' => 'Personnel 001',
            'email' => 'personnel001@example.com',
            'telephone' => '1234567890',
            'adresse' => '123 Main St',
            'niveau_cadre' => 'Niveau 1',
            'poste' => 'Poste 1',
        ]);

        DB::table('personnels')->insert([
            'code' => 'P002',
            'nom' => 'Personnel 002',
            'prenom' => 'Personnel 002',
            'email' => 'personnel002@example.com',
            'telephone' => '0987654321',
            'adresse' => '456 Elm St',
            'niveau_cadre' => 'Niveau 2',
            'poste' => 'Poste 2',
        ]);

        DB::table('personnels')->insert([
            'code' => 'P003',
            'nom' => 'Personnel 003',
            'prenom' => 'Personnel 003',
            'email' => 'personnel003@example.com',
            'telephone' => '1122334455',
            'adresse' => '789 Oak St',
            'niveau_cadre' => 'Niveau 3',
            'poste' => 'Poste 3',
        ]);

        DB::table('personnels')->insert([
            'code' => 'P004',
            'nom' => 'Personnel 004',
            'prenom' => 'Personnel 004',
            'email' => 'personnel004@example.com',
            'telephone' => '5566778899',
            'adresse' => '101 Pine St',
            'niveau_cadre' => 'Niveau 4',
            'poste' => 'Poste 4',
        ]);

        DB::table('personnels')->insert([
            'code' => 'P005',
            'nom' => 'Personnel 005',
            'prenom' => 'Personnel 005',
            'email' => 'personnel005@example.com',
            'telephone' => '6677889900',
            'adresse' => '202 Maple St',
            'niveau_cadre' => 'Niveau 5',
            'poste' => 'Poste 5',
        ]);

        DB::table('personnels')->insert([
            'code' => 'P006',
            'nom' => 'Personnel 006',
            'prenom' => 'Personnel 006',
            'email' => 'personnel006@example.com',
            'telephone' => '7788990011',
            'adresse' => '303 Birch St',
            'niveau_cadre' => 'Niveau 6',
            'poste' => 'Poste 6',
        ]);

        DB::table('personnels')->insert([
            'code' => 'P007',
            'nom' => 'Personnel 007',
            'prenom' => 'Personnel 007',
            'email' => 'personnel007@example.com',
            'telephone' => '8899001122',
            'adresse' => '404 Cedar St',
            'niveau_cadre' => 'Niveau 7',
            'poste' => 'Poste 7',
        ]);

        DB::table('personnels')->insert([
            'code' => 'P008',
            'nom' => 'Personnel 008',
            'prenom' => 'Personnel 008',
            'email' => 'personnel008@example.com',
            'telephone' => '9900112233',
            'adresse' => '505 Spruce St',
            'niveau_cadre' => 'Niveau 8',
            'poste' => 'Poste 8',
        ]);

        DB::table('personnels')->insert([
            'code' => 'P009',
            'nom' => 'Personnel 009',
            'prenom' => 'Personnel 009',
            'email' => 'personnel009@example.com',
            'telephone' => '0011223344',
            'adresse' => '606 Fir St',
            'niveau_cadre' => 'Niveau 9',
            'poste' => 'Poste 9',
        ]);

        DB::table('personnels')->insert([
            'code' => 'P010',
            'nom' => 'Personnel 010',
            'prenom' => 'Personnel 010',
            'email' => 'personnel010@example.com',
            'telephone' => '1122446688',
            'adresse' => '707 Willow St',
            'niveau_cadre' => 'Niveau 10',
            'poste' => 'Poste 10',
        ]);

        DB::table('personnels')->insert([
            'code' => 'P011',
            'nom' => 'Personnel 011',
            'prenom' => 'Personnel 011',
            'email' => 'personnel011@example.com',
            'telephone' => '2233557799',
            'adresse' => '808 Chestnut St',
            'niveau_cadre' => 'Niveau 11',
            'poste' => 'Poste 11',
        ]);

        DB::table('personnels')->insert([
            'code' => 'P012',
            'nom' => 'Personnel 012',
            'prenom' => 'Personnel 012',
            'email' => 'personnel012@example.com',
            'telephone' => '3344668800',
            'adresse' => '909 Walnut St',
            'niveau_cadre' => 'Niveau 12',
            'poste' => 'Poste 12',
        ]);
    }
}
