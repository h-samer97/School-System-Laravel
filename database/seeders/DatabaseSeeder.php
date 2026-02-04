<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;



class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       $this->call([
            BloodTableSeeder::class,
            NationalitiesTableSeeder::class,
            ReligionTableSeeder::class,
            Gender::class,
            Specialization::class,

            GradeSeeder::class,
            ClassroomsSeeder::class,
            SectionsSeeder::class,

            ParentsSeeder::class,
            TeachersSeeder::class,
            TeachersSectionsSeeder::class,

            Students::class,
]);

    }
}
