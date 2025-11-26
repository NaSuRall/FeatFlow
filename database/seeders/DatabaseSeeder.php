<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'last_name'     => 'Doe',
            'first_name'    => 'John',
            'email'         => 'test@feedflow.local',
            'password'      => bcrypt('password'),
        ]);

        User::create([
            'last_name'     => 'Jack',
            'first_name'    => 'John',
            'email'         => 'testtt@feedflowfddffd.lfdfdocal',
            'password'      => bcrypt('password'),
        ]);

        User::create([
            'last_name'     => 'Michael',
            'first_name'    => 'Joly',
            'email'         => 'testttt@feedflbcvbow.lofdhbnncal',
            'password'      => bcrypt('password1'),
        ]);

    }
}
