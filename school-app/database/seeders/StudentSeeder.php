<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('students')->insert([
            'name'=>'Luis',
            'last_name'=> 'Castro',
            'age'=>19,
            'identification_card'=> '20458963HBK',
            'email'=>'luiscastro@hotmail.com',
            'created_at'=> \Carbon\Carbon::now()
        ]);
    }
}
