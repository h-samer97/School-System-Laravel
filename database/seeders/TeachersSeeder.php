<?php

namespace Database\Seeders;

use App\Models\Teacher_Section;
use App\Models\Teachers;
use DB;
use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeachersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    DB::table('teachers')->delete();

    $teachers = [
        [
            'email' => 'teacher1@example.com',
            'password' => Hash::make('12345678'),
            'name' => 'Ahmad Youssef',
            'specialization_id' => 1,
            'gender_id' => 1,
            'joining_Date' => '2020-09-01',
            'address' => 'Damascus - Kafarsouseh',
        ],
        [
            'email' => 'teacher2@example.com',
            'password' => Hash::make('12345678'),
            'name' => 'Rana Ibrahim',
            'specialization_id' => 3,
            'gender_id' => 2,
            'joining_Date' => '2021-02-15',
            'address' => 'Damascus - Baramkeh',
        ],
        [
            'email' => 'teacher3@example.com',
            'password' => Hash::make('12345678'),
            'name' => 'Mahmoud Ali',
            'specialization_id' => 2,
            'gender_id' => 1,
            'joining_Date' => '2019-11-20',
            'address' => 'Aleppo - New City',
        ],
    ];

    foreach ($teachers as $teacher) {
        Teachers::create($teacher);
    }
}

}
