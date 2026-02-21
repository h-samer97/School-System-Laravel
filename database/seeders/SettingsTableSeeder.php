<?php

namespace Database\Seeders;

use App\Models\Setting;
use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('settings')->delete();

    $settings = [
            ['key' => 'school_name', 'value' => 'مدرسة النخبة النموذجية'],
            ['key' => 'school_email', 'value' => 'info@school.com'],
            ['key' => 'phone', 'value' => '0123456789'],
            ['key' => 'address', 'value' => 'الشارع الرئيسي، المدينة'],
            ['key' => 'current_session', 'value' => '2023-2024'],
            ['key' => 'school_title', 'value' => 'S.M.S'],
            ['key' => 'logo', 'value' => 'logo.png'],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(['key' => $setting['key']], $setting);
        }
    }
}
