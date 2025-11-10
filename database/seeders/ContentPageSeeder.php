<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ContentPage;

class ContentPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pages = [
            [
                'title' => [
                    'en' => 'Alumni Constitution',
                    'bn' => 'প্রাক্তন ছাত্র সংবিধান',
                ],
                'slug' => 'constitution',
                'content' => [
                    'en' => 'This is the default content for the Constitution page. Please update it from the admin panel.',
                    'bn' => 'সংবিধান পৃষ্ঠার জন্য এটি ডিফল্ট বিষয়বস্তু। অ্যাডমিন প্যানেল থেকে এটি আপডেট করুন।',
                ],
                'is_published' => false,
            ],
            [
                'title' => [
                    'en' => 'About Us',
                    'bn' => 'আমাদের সম্পর্কে',
                ],
                'slug' => 'about-us',
                'content' => [
                    'en' => 'This is the default content for the About Us page. Please update it from the admin panel.',
                    'bn' => 'আমাদের সম্পর্কে পৃষ্ঠার জন্য এটি ডিফল্ট বিষয়বস্তু। অ্যাডমিন প্যানেল থেকে এটি আপডেট করুন।',
                ],
                'is_published' => false,
            ],
            [
                'title' => [
                    'en' => 'FAQ',
                    'bn' => 'সচরাচর জিজ্ঞাস্য',
                ],
                'slug' => 'faq',
                'content' => [
                    'en' => 'This is the default content for the FAQ page. Please update it from the admin panel.',
                    'bn' => 'সচরাচর জিজ্ঞাস্য পৃষ্ঠার জন্য এটি ডিফল্ট বিষয়বস্তু। অ্যাডমিন প্যানেল থেকে এটি আপডেট করুন।',
                ],
                'is_published' => false,
            ],
            [
                'title' => [
                    'en' => 'Privacy Policy',
                    'bn' => 'গোপনীয়তা নীতি',
                ],
                'slug' => 'privacy-policy',
                'content' => [
                    'en' => 'This is the default content for the Privacy Policy page. Please update it from the admin panel.',
                    'bn' => 'গোপনীয়তা নীতি পৃষ্ঠার জন্য এটি ডিফল্ট বিষয়বস্তু। অ্যাডমিন প্যানেল থেকে এটি আপডেট করুন।',
                ],
                'is_published' => false,
            ],
        ];

        foreach ($pages as $page) {
            ContentPage::updateOrCreate(
                ['slug' => $page['slug']],
                [
                    'title' => $page['title'],
                    'content' => $page['content'],
                    'is_published' => $page['is_published'],
                ]
            );
        }
    }
}