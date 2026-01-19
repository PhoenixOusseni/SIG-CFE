<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'nom' => 'SUPERVISEUR',
            'prenom' => 'Superviseur',
            'email' => 'superviseur@gmail.com',
            'login' => 'superviseur',
            'activate' => 1,
            'role' => 'superviseur',
            'password' => Hash::make('superviseur'),
        ]);
    }
}
