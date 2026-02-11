<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersTableSeeder::class,
            FamilleSeeder::class,
            SourceSeeder::class,
            FournisseurSeeder::class,
            BudgetSeeder::class,
            CategorieSeeder::class,
            ContribuableSeeder::class,
            PersonnelSeeder::class,
        ]);
    }
}
