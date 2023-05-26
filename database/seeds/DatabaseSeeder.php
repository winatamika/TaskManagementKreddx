<?php

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
        // $this->call(UsersTableSeeder::class);
        User::create([
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'password' => bcrypt('password')
        ]);

        User::create([
            'name' => 'Mika',
            'email' => 'mika@example.com',
            'password' => bcrypt('password')
        ]);

    }
}
