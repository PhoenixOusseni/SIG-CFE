<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FamilleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('familles')->insert([
            'libelle' => 'Département 001',
            'taux' => 5,
        ]);

        DB::table('familles')->insert([
            'libelle' => 'Département 002',
            'taux' => 10,
        ]);

        DB::table('familles')->insert([
            'libelle' => 'Département 003',
            'taux' => 15,
        ]);
    }
}
