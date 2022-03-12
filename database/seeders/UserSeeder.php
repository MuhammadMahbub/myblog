<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'boss',
            'email' => 'boss@gmail.com',
            'password' => Hash::make('boss@gmail.com'),
            'role_as' => 1,
            'created_at' => Carbon::now(),
        ], [
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin@gmail.com'),
            'role_as' => 1,
            'created_at' => Carbon::now(),
        ]);
    }
}
