<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BudgetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('budgets')->insert([
            'libelle' => 'Recette eau souteraine',
            'dotation' => 1000000,
            'type' => 'Recette',
        ]);

        DB::table('budgets')->insert([
            'libelle' => 'Paiement factures fournisseurs',
            'dotation' => 150000000,
            'type' => 'Dépense',
        ]);
    }
}
