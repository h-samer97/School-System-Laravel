<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class Specialization extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('specializations')->delete();

        $specializations = [
            ['en' => 'Math', 'ar' => 'رياضيات'],
            ['en' => 'physics', 'ar' => 'فيزياء'],
            ['en' => 'biology', 'ar' => 'علم الأحياء'],
            ['en' => 'chemistry', 'ar' => 'كيمياء'],
            ['en' => 'Arabic', 'ar' => 'اللغة العربية'],
            ['en' => 'English', 'ar' => 'اللغة الإنجليزية'],
            ['en' => 'Computer', 'ar' => 'معلوماتية'],
            ['en' => 'spain', 'ar' => 'اللغة الإسبانية']
        ];


        foreach($specializations as $sp) {

            \App\Models\Specialization::create([
                'name' => $sp
            ]);

        }


    }
}
