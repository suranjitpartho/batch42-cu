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
                    'bn' => 'অ্যালামনাই সংবিধান',
                ],
                'slug' => 'constitution',
                'content' => [
                    'en' => '',
                    'bn' => '',
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
                    'en' => '',
                    'bn' => '',
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
                    'en' => '',
                    'bn' => '',
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
                    'en' => '',
                    'bn' => '',
                ],
                'is_published' => false,
            ],
            [
                'title' => [
                    'en' => 'Social Media Links',
                ],
                'slug' => 'social-media-links',
                'content' => [
                    'en' => json_encode([
                        'facebook_url' => '',
                        'twitter_url' => '',
                        'instagram_url' => '',
                        'linkedin_url' => '',
                        'youtube_url' => '',
                    ]),
                ],
                'is_published' => true,
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