<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;

use Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Rafi Wibawa ARuan',
            'email' => 'rafiwibawa14@gmail.com',
            'password' => Hash::make('secret')
        ]);
    }
}
