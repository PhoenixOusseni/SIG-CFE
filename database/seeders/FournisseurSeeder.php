<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FournisseurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('fournisseurs')->insert([
            'libelle' => 'Safreco',
            'adresse' => 'Patte d\'oie',
            'telephone' => 67186063,
            'ifu' => '0112005J',
            'rccm' => 'B473350',
        ]);
    }
}
