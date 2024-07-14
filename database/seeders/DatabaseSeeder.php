<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{

    public function run() : void
    {
        DB::table('users')->insert([
            'name' => 'User',
            'email' => 'admin@gmail.com',
            'phone' => '0904613293',
            'address' => 'Ho Chi Minh',
            'gender' => 'male',
            'password' =>  Hash::make('123'),
        ]);

    }
}
