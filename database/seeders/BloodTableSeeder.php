<?php

namespace Database\Seeders;

use App\Models\TypeBlood;
use DB;
use Illuminate\Database\Seeder;


class BloodTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("type_bloods")->delete();

        $bgs = ['O-', 'O+', 'A+', 'A-', 'B+', 'B-', 'AB+', 'AB-'];

        foreach($bgs as $bg) {

            TypeBlood::create(['name' => $bg]);

        }
    }
}
