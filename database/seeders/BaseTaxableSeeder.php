<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BaseTaxableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('base_taxables')->insert([
            'libelle' => 'Eau souteraine',
            'reference' => 'RAS',
            'prix' => 700,
            'familles_id' => 1,
        ]);
    }
}
