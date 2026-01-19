<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContribuableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('contribuables')->insert([
            'assujeti' => 'Mokutech',
            'adresse' => '1500',
            'telephone' => 75015560,
            'ifu' => '5012005R',
            'rccm' => 'C203350',
            'categories_id' => 1,
        ]);
    }
}
