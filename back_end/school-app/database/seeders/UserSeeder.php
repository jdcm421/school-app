<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name'=>'Leonardo',
            'last_name'=>'Villaran',
            'email' => 'leovillaran@hotmail.com',
            'email_verified_at' => \Carbon\Carbon::now(),
            'password' => Hash::make('Lgoptimusg3$'),
            'roles_id' => 1,
            'created_at'=> \Carbon\Carbon::now()
        ]);

        DB::table('users')->insert([
            'name'=>'Teodoro',
            'last_name'=>'Castro',
            'email' => 'teocastro@hotmail.com',
            'email_verified_at' => \Carbon\Carbon::now(),
            'password' => Hash::make('Lgoptimusg2$'),
            'roles_id' => 2,
            'created_at'=> \Carbon\Carbon::now()
        ]);
    }
}
