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
        DB::table('users')->insert([
            'firstname' => 'Niels',
            'lastname' => 'Cappelle',
            'email' => 'cappelleniels@hotmail.com',
            'password' => bcrypt('secret'),
            'profile_picture' => '/uploads/profiles/niels.jpeg',
            'type' => 0,
        ]);

        DB::table('users')->insert([
            'firstname' => 'Victorine',
            'lastname' => 'Sesier',
            'email' => 'victorine.sesier@hotmail.com',
            'password' => bcrypt('secret'),
            'profile_picture' => '/uploads/profiles/victorine.jpeg',
            'type' => 1,
        ]);
    }
}
