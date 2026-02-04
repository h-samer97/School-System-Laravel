<?php

namespace Database\Seeders;

use App\Models\SParent;
use DB;
use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ParentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    DB::table('s_parent')->delete();

    $parents = [
        [
            'email' => 'father1@example.com',
            'password' => Hash::make('12345678'),

            'name_Father' => 'Khaled Ahmad',
            'national_ID_father' => '12345678901234',
            'passport_ID_father' => 'A1234567',
            'phone_father' => '0999888777',
            'job_father' => 'Engineer',
            'nationality_father_id' => 1,
            'blood_type_father_id' => 1,
            'religion_father_id' => 1,
            'address_father' => 'Damascus - Mezzeh',

            'name_mother' => 'Fatima Ali',
            'national_ID_mother' => '98765432109876',
            'passport_ID_mother' => 'B7654321',
            'phone_mother' => '0999111222',
            'job_mother' => 'Teacher',
            'nationality_mother_id' => 1,
            'blood_type_mother_id' => 2,
            'religion_mother_id' => 1,
            'address_mother' => 'Damascus - Mezzeh',
        ],

        [
            'email' => 'father2@example.com',
            'password' => Hash::make('12345678'),

            'name_Father' => 'Mahmoud Saleh',
            'national_ID_father' => '11223344556677',
            'passport_ID_father' => 'C9988776',
            'phone_father' => '0999333444',
            'job_father' => 'Doctor',
            'nationality_father_id' => 2,
            'blood_type_father_id' => 2,
            'religion_father_id' => 2,
            'address_father' => 'Aleppo - New City',

            'name_mother' => 'Rana Hassan',
            'national_ID_mother' => '77665544332211',
            'passport_ID_mother' => 'D5544332',
            'phone_mother' => '0999000111',
            'job_mother' => 'Nurse',
            'nationality_mother_id' => 2,
            'blood_type_mother_id' => 1,
            'religion_mother_id' => 2,
            'address_mother' => 'Aleppo - New City',
        ],
    ];

    foreach ($parents as $parent) {
        SParent::create($parent);
    }
}

}
