<?php

namespace Database\Seeders;

use App\Models\Video;
use Illuminate\Database\Seeder;

class VideoSeeder extends Seeder
{
    public function run(): void
    {
        $videos = [
            [
                'title' => 'SR Greenscapes - Company Overview',
                'description' => 'Discover how SR Greenscapes Pvt Ltd transforms outdoor spaces with science-driven, sustainable landscaping solutions across India.',
                'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'thumbnail' => 'Home/1.1Cover photo 1.jpg',
                'category' => 'About Us',
                'is_active' => true,
                'order' => 1,
            ],
            [
                'title' => 'Landscape Design & Execution Process',
                'description' => 'Watch our step-by-step landscape design process from concept to completion. See how we plan, design and execute stunning outdoor spaces.',
                'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'thumbnail' => 'Home/1.16 Landscape Design  Execution.png',
                'category' => 'Services',
                'is_active' => true,
                'order' => 2,
            ],
            [
                'title' => 'Miyawaki Forest Creation - Time Lapse',
                'description' => 'Watch a Miyawaki mini-forest come to life in just 6 months. Dense, native forests created using scientific planting methods.',
                'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'thumbnail' => 'Home/1.9 Sustainability at the Core.jpg',
                'category' => 'Projects',
                'is_active' => true,
                'order' => 3,
            ],
            [
                'title' => 'Terrace Garden Setup Guide',
                'description' => 'Learn how to set up a beautiful terrace garden with proper waterproofing, drainage, soil mix, and plant selection tips from our experts.',
                'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'thumbnail' => 'Home/1.5 Cover photo 5.jpg',
                'category' => 'Tutorials',
                'is_active' => true,
                'order' => 4,
            ],
            [
                'title' => 'Commercial Campus Landscaping - IT Park Project',
                'description' => 'See how we transformed a barren IT park campus into a lush green workspace with sustainable landscaping and native plant species.',
                'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'thumbnail' => 'Home/1.12 End-to-End Execution.jpg',
                'category' => 'Projects',
                'is_active' => true,
                'order' => 5,
            ],
            [
                'title' => 'Vertical Garden Installation Process',
                'description' => 'Watch our team install a stunning vertical green wall. From frame setup to planting, see the complete process in this video.',
                'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'thumbnail' => 'Home/1.17 Specialized Garden Services.jpg',
                'category' => 'Services',
                'is_active' => true,
                'order' => 6,
            ],
        ];

        foreach ($videos as $video) {
            Video::create($video);
        }
    }
}
