<?php

use Illuminate\Database\Seeder;

class UsersSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => Str::random(10),
            'email' => Str::random(10).'@gmail.com',
            'password' => bcrypt('secret'),
            'birthdate' => Date::random,
            'username' => 'admin',
            'lastname' => Str::random(10),
            'role' => 'admin'
        ]);

        DB::table('users')->insert([
            'name' => Str::random(10),
            'email' => Str::random(10).'@gmail.com',
            'password' => bcrypt('secret'),
            'birthdate' => Date::random,
            'username' => 'blogger',
            'lastname' => Str::random(10),
            'role' => 'blogger'
        ]);
    }
}
