<?php

use Illuminate\Database\Seeder;
use somosAula\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    \DB::table('users')->delete();
        User::create([
            'name' => 'jordan',
            'email' => 'bj.devreugd@gmail.com',
            'password'=> bcrypt('jordan')
        ]);
    }
}
