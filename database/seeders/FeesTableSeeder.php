<?php

namespace Database\Seeders;

use App\Models\Fees;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('fees')->delete();

        $fees = [

            [
                'title' => ['en' => 'Bus Service', 'ar' => 'خدمة الحافلة'],
                'amount' => 500.00,
                'grade_id' => 1,
                'classroom_id' => 1,
                'description' => 'وصول ذهاب وإياب',
                'year' => '2026',
                'fee_type' => 2,
            ],
            [
                'title' => ['en' => 'High-Speed Internet', 'ar' => 'إنترنت فائق السرعة'],
                'amount' => 150.00,
                'grade_id' => 1,
                'classroom_id' => 1,
                'description' => 'اشتراك إنترنت فصلي',
                'year' => '2026',
                'fee_type' => 2,
            ],

            [
                'title' => ['en' => 'University Transportation', 'ar' => 'مواصلات الجامعية'],
                'amount' => 700.00,
                'grade_id' => 3,
                'classroom_id' => 9,
                'description' => 'نقل خارجي للمحافظات',
                'year' => '2026',
                'fee_type' => 2,
            ],
            [
                'title' => ['en' => 'Health Insurance', 'ar' => 'تأمين صحي جامعي'],
                'amount' => 300.00,
                'grade_id' => 3,
                'classroom_id' => 9,
                'description' => 'تأمين شامل للفصل الدراسي',
                'year' => '2026',
                'fee_type' => 2,
            ],
            [
                'title' => ['en' => 'E-Library Access', 'ar' => 'الوصول للمكتبة الإلكترونية'],
                'amount' => 100.00,
                'grade_id' => 3,
                'classroom_id' => 9,
                'description' => 'اشتراك في قواعد البيانات البحثية',
                'year' => '2026',
                'fee_type' => 2,
            ],
        ];

        foreach ($fees as $fee) {
            Fees::create($fee);
        }
    }
}
