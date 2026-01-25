<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class Gender extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('genders')->delete();

        $gender = [
            ['en' => 'Female', 'ar' => 'أنثى'],
            ['en' => 'Male', 'ar' => 'ذكر'],
            ['en' => 'Other', 'ar' => 'غير ذلك']
        ];

        foreach($gender as $g) {

            \App\Models\Gender::create([
                'name' => $g
            ]);

        }

    }
}
