<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new \App\User([
            'name' => 'user1',
            'email' => 'user1@test.com',
            'password' => bcrypt('user1')
        ]);

        $user->save();

    }
}
