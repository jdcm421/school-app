<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('courses')->insert([
            'name' => 'Diseño Grafico',
            'date_start' => '2024-04-28',
            'date_end' => '2024-12-05',
            'schedule' => '09:30:00 - 12:00:00',
            'type' => 'Presencial',
            'created_at'=> \Carbon\Carbon::now()
        ]);
    }
}
