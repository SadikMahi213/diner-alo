<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DonationFundSeeder extends Seeder
{
    /**
     * Seed the donation funds used on the homepage donation form.
     */
    public function run(): void
    {
        if (DB::table('project_categories')->where('name_en', 'General Fund')->exists()) {
            $categoryId = DB::table('project_categories')->where('name_en', 'General Fund')->value('id');
        } else {
            $categoryId = DB::table('project_categories')->insertGetId([
                'name_bn' => 'সাধারণ তহবিল',
                'name_en' => 'General Fund',
                'description' => 'আন-নুসরা ফাউন্ডেশনের সাধারণ তহবিল',
                'icon' => null,
                'color' => 'green',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        DB::table('donation_funds')->where('category_id', $categoryId)->delete();

        $funds = [
            [
                'name_bn' => 'যাকাত',
                'name_en' => 'Zakat',
                'description' => 'আপনার যাকাত প্রদান করুন',
            ],
            [
                'name_bn' => 'সাদাকাহ',
                'name_en' => 'Sadaqah',
                'description' => 'সদকা ও খয়রাত প্রদান করুন',
            ],
            [
                'name_bn' => 'শিক্ষা তহবিল',
                'name_en' => 'Education Fund',
                'description' => 'শিক্ষা কার্যক্রমে সহায়তা করুন',
            ],
            [
                'name_bn' => 'জরুরী তহবিল',
                'name_en' => 'Emergency Fund',
                'description' => 'জরুরি ত্রাণ ও সহায়তায় অংশ নিন',
            ],
            [
                'name_bn' => 'শীতবার্তা তহবিল',
                'name_en' => 'Winter Clothing Fund',
                'description' => 'শীতবস্ত্র বিতরণে অবদান রাখুন',
            ],
            [
                'name_bn' => 'কুরবানি তহবিল',
                'name_en' => 'Qurbani Fund',
                'description' => 'কুরবানির গোশত বিতরণে অংশ নিন',
            ],
        ];

        foreach ($funds as $fund) {
            DB::table('donation_funds')->insert(array_merge($fund, [
                'category_id' => $categoryId,
                'icon' => null,
                'minimum_amount' => 100,
                'suggested_amounts' => '[]',
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}