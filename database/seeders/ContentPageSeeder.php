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
                'title' => 'Alumni Constitution',
                'slug' => 'constitution',
                'content' => 'This is the default content for the Constitution page. Please update it from the admin panel.',
                'is_published' => false,
            ],
            [
                'title' => 'About Us',
                'slug' => 'about-us',
                'content' => 'This is the default content for the About Us page. Please update it from the admin panel.',
                'is_published' => false,
            ],
            [
                'title' => 'FAQ',
                'slug' => 'faq',
                'content' => 'This is the default content for the FAQ page. Please update it from the admin panel.',
                'is_published' => false,
            ],
            [
                'title' => 'Privacy Policy',
                'slug' => 'privacy-policy',
                'content' => 'This is the default content for the Privacy Policy page. Please update it from the admin panel.',
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