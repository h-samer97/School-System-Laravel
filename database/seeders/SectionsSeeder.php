<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SectionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    DB::table('sections')->delete();

    $sections = [
        // Grade 1 — Primary
        ['grade_id' => 1, 'class_id' => 1, 'name_section' => 'Section A', 'status' => 1],
        ['grade_id' => 1, 'class_id' => 2, 'name_section' => 'Section B', 'status' => 1],
        ['grade_id' => 1, 'class_id' => 3, 'name_section' => 'Section C', 'status' => 1],

        // Grade 2 — Middle
        ['grade_id' => 2, 'class_id' => 5, 'name_section' => 'Section A', 'status' => 1],
        ['grade_id' => 2, 'class_id' => 6, 'name_section' => 'Section B', 'status' => 1],
        ['grade_id' => 2, 'class_id' => 7, 'name_section' => 'Section C', 'status' => 1],

        // Grade 3 — High School
        ['grade_id' => 3, 'class_id' => 9,  'name_section' => 'Section A', 'status' => 1],
        ['grade_id' => 3, 'class_id' => 10, 'name_section' => 'Section B', 'status' => 1],
        ['grade_id' => 3, 'class_id' => 11, 'name_section' => 'Section C', 'status' => 1],
    ];

    foreach ($sections as $section) {
        \App\Models\Section::create($section);
    }
}

}
