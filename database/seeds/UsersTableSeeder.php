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
        DB::table('users')->insert([
            'name' => 'user1',
            'email' => 'user1@mail.com',
            'password' => bcrypt('password'),
            'created_at'=> \DB::raw('CURRENT_TIMESTAMP'),
            'updated_at'=> \DB::raw('CURRENT_TIMESTAMP'),
          ]);
        DB::table('users')->insert([
            'name' => 'user2',
            'email' => 'user2@mail.com',
            'password' => bcrypt('password'),
            'created_at'=> \DB::raw('CURRENT_TIMESTAMP'),
            'updated_at'=> \DB::raw('CURRENT_TIMESTAMP'),
          ]);
    }
}
