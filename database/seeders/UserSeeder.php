<?php

namespace Database\Seeders;

use App\Models\User;
use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->delete();

        User::updateOrCreate([

                'email' => 'root@root.com',
                'name' => 'root',
                'password' => Hash::make('root'),
                'email_verified_at' => now(),
        ]
            
        );
    }
    }
