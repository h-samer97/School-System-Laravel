<?php

namespace Database\Seeders;

use App\Models\Teacher_Section;
use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeachersSectionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    DB::table('teacher__sections')->delete();

    $teacher_sections = [
        ['teacher_id' => 1, 'section_id' => 1],
        ['teacher_id' => 1, 'section_id' => 2],
        ['teacher_id' => 1, 'section_id' => 3],

        ['teacher_id' => 2, 'section_id' => 4],
        ['teacher_id' => 2, 'section_id' => 5],
        ['teacher_id' => 2, 'section_id' => 6],

        ['teacher_id' => 3, 'section_id' => 7],
        ['teacher_id' => 3, 'section_id' => 8],
        ['teacher_id' => 3, 'section_id' => 9],
    ];

    foreach ($teacher_sections as $ts) {
        Teacher_Section::create($ts);
    }
}

}
