<?php

namespace Database\Seeders;

use App\Models\Student;
use Hash;
use Illuminate\Database\Seeder;
use DB;

class Students extends Seeder
{
    /**
     * Run the database seeds.
     */
   public function run(): void
{
    DB::table('students')->delete();

    $students = [
        [
            'name' => [
                'en' => 'Ahmed Khaled',
                'ar' => 'أحمد خالد',
            ],
            'email' => 'ahmed@example.com',
            'password' => Hash::make('12345678'),
            'gender_id' => 1,
            'nationalitie_id' => 1,
            'blood_id' => 1,
            'date_birth' => '2008-05-12',
            'grade_id' => 1,
            'classroom_id' => 1,
            'section_id' => 1,
            'parent_id' => 1,
            'academic_year' => '2024-2025',
        ],

        [
            'name' => [
                'en' => 'Sara Mahmoud',
                'ar' => 'سارة محمود',
            ],
            'email' => 'sara@example.com',
            'password' => Hash::make('12345678'),
            'gender_id' => 2,
            'nationalitie_id' => 2,
            'blood_id' => 2,
            'date_birth' => '2009-11-03',
            'grade_id' => 2,
            'classroom_id' => 4,
            'section_id' => 2,
            'parent_id' => 2,
            'academic_year' => '2024-2025',
        ],

        [
            'name' => [
                'en' => 'Samer hajara',
                'ar' => 'سامر حجارة',
            ],
            'email' => 'samer@example.com',
            'password' => Hash::make('12345678'),
            'gender_id' => 1,
            'nationalitie_id' => 2,
            'blood_id' => 2,
            'date_birth' => '2009-11-03',
            'grade_id' => 1,
            'classroom_id' => 1,
            'section_id' => 1,
            'parent_id' => 2,
            'academic_year' => '2024-2025',
        ],
    ];

    foreach ($students as $student) {
        Student::create($student);
    }
}
}

