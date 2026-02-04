<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    DB::table('grades')->delete();

    $grades = [
        [
            'Name'  => 'Primary',
            'Notes' => 'First stage of school',
        ],
        [
            'Name'  => 'Middle',
            'Notes' => 'Intermediate stage',
        ],
        [
            'Name'  => 'High School',
            'Notes' => 'Final school stage before university',
        ],
    ];

    foreach ($grades as $grade) {
        \App\Models\Grade::create($grade);
    }
}

}
