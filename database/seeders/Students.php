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
                'name' => ['en' => 'Samer Hajara', 'ar' => 'سامر حجارة'],
                'email' => 'samer@example.com',
                'password' => Hash::make('12345678'),
                'gender_id' => 2,
                'nationalitie_id' => 1,
                'blood_id' => 1,
                'date_birth' => '2005-01-01',
                'grade_id' => 1,
                'classroom_id' => 1,
                'section_id' => 1,
                'parent_id' => 1,
                'academic_year' => '2026',
            ],
            [
                'name' => ['en' => 'Ahmed Mohamed', 'ar' => 'أحمد محمد'],
                'email' => 'ahmed@example.com',
                'password' => Hash::make('12345678'),
                'gender_id' => 1,
                'nationalitie_id' => 1,
                'blood_id' => 1,
                'date_birth' => '2006-05-10',
                'grade_id' => 3,
                'classroom_id' => 9,
                'section_id' => 7,
                'parent_id' => 1,
                'academic_year' => '2026',
            ],
            [
                'name' => ['en' => 'Sara Ali', 'ar' => 'سارة علي'],
                'email' => 'sara@example.com',
                'password' => Hash::make('12345678'),
                'gender_id' => 2,
                'nationalitie_id' => 1,
                'blood_id' => 2,
                'date_birth' => '2006-08-15',
                'grade_id' => 3,
                'classroom_id' => 9,
                'section_id' => 7,
                'parent_id' => 1,
                'academic_year' => '2026',
            ],
            [
                'name' => ['en' => 'Khaled Hassan', 'ar' => 'خالد حسن'],
                'email' => 'khaled@example.com',
                'password' => Hash::make('12345678'),
                'gender_id' => 1,
                'nationalitie_id' => 1,
                'blood_id' => 1,
                'date_birth' => '2005-12-20',
                'grade_id' => 3,
                'classroom_id' => 9,
                'section_id' => 7,
                'parent_id' => 1,
                'academic_year' => '2026',
            ],
        ];

    foreach ($students as $student) {
        Student::create($student);
    }
}
}

