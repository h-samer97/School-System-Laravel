<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClassroomsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    DB::table('classrooms')->delete();

    $classrooms = [
        // Primary
        ['grade_id' => 1, 'name_class' => 'Class 1A'],
        ['grade_id' => 1, 'name_class' => 'Class 1B'],
        ['grade_id' => 1, 'name_class' => 'Class 2A'],
        ['grade_id' => 1, 'name_class' => 'Class 2B'],

        // Middle
        ['grade_id' => 2, 'name_class' => 'Class 7A'],
        ['grade_id' => 2, 'name_class' => 'Class 7B'],
        ['grade_id' => 2, 'name_class' => 'Class 8A'],
        ['grade_id' => 2, 'name_class' => 'Class 8B'],

        // High School
        ['grade_id' => 3, 'name_class' => 'Class 10A'],
        ['grade_id' => 3, 'name_class' => 'Class 10B'],
        ['grade_id' => 3, 'name_class' => 'Class 11A'],
        ['grade_id' => 3, 'name_class' => 'Class 11B'],
    ];

    foreach ($classrooms as $classroom) {
        \App\Models\Classroom::create($classroom);
    }
}

}
