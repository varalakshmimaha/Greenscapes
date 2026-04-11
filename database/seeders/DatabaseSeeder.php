<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Menu;
use App\Models\Setting;
use App\Models\Service;
use App\Models\Faq;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create Admin User
        User::create([
            'name' => 'Admin',
            'email' => 'admin@ecoscapes.in',
            'password' => Hash::make('password'),
            'is_admin' => true,
            'role' => 'admin',
        ]);

        // Default Menu Items
        $home = Menu::create(['title' => 'Home', 'url' => '/', 'order' => 1, 'is_active' => true]);

        $aboutMenu = Menu::create(['title' => 'About Us', 'url' => '/about', 'order' => 2, 'has_dropdown' => true, 'is_active' => true]);
        Menu::create(['title' => 'Company Overview', 'url' => '/about#overview', 'parent_id' => $aboutMenu->id, 'order' => 1, 'is_active' => true]);
        Menu::create(['title' => 'Our Team', 'url' => '/about#team', 'parent_id' => $aboutMenu->id, 'order' => 2, 'is_active' => true]);
        Menu::create(['title' => 'Vision & Mission', 'url' => '/about#vision', 'parent_id' => $aboutMenu->id, 'order' => 3, 'is_active' => true]);

        $servicesMenu = Menu::create(['title' => 'Services', 'url' => '/services', 'order' => 3, 'has_dropdown' => true, 'is_active' => true]);
        Menu::create(['title' => 'Landscape Design and Execution', 'url' => '/services/landscape-design', 'parent_id' => $servicesMenu->id, 'order' => 1, 'is_active' => true]);
        Menu::create(['title' => 'Landscape Maintenance', 'url' => '/services/landscape-maintenance', 'parent_id' => $servicesMenu->id, 'order' => 2, 'is_active' => true]);

        Menu::create(['title' => 'Projects', 'url' => '/projects', 'order' => 4, 'is_active' => true]);
        Menu::create(['title' => "FAQ's", 'url' => '/faqs', 'order' => 5, 'is_active' => true]);
        Menu::create(['title' => 'Contacts', 'url' => '/contact', 'order' => 6, 'is_active' => true]);

        // Default Services
        Service::create([
            'name' => 'Hardscape', 'slug' => 'hardscape',
            'description' => 'Professional hardscape design including patios, walkways, retaining walls, and outdoor structures.',
            'category' => 'design', 'order' => 1, 'is_active' => true,
        ]);
        Service::create([
            'name' => 'Softscape', 'slug' => 'softscape',
            'description' => 'Complete softscape services including planting, garden beds, lawns, and organic landscapes.',
            'category' => 'design', 'order' => 2, 'is_active' => true,
        ]);
        Service::create([
            'name' => 'Vertical Garden', 'slug' => 'vertical-garden',
            'description' => 'Innovative vertical garden installations for walls and limited spaces.',
            'category' => 'design', 'order' => 3, 'is_active' => true,
        ]);
        Service::create([
            'name' => 'Aquatic Ponds', 'slug' => 'aquatic-ponds',
            'description' => 'Custom aquatic pond design and installation with water features.',
            'category' => 'design', 'order' => 4, 'is_active' => true,
        ]);
        Service::create([
            'name' => 'Terrace Garden', 'slug' => 'terrace-garden',
            'description' => 'Beautiful terrace garden designs to transform your rooftop.',
            'category' => 'design', 'order' => 5, 'is_active' => true,
        ]);
        Service::create([
            'name' => 'Balcony Garden', 'slug' => 'balcony-garden',
            'description' => 'Space-efficient balcony garden solutions for urban living.',
            'category' => 'design', 'order' => 6, 'is_active' => true,
        ]);

        // Default FAQs
        Faq::create(['question' => 'What services does Ecoscapes provide?', 'answer' => 'We provide complete landscaping solutions including landscape design, execution, and maintenance services.', 'order' => 1]);
        Faq::create(['question' => 'How long does a typical landscaping project take?', 'answer' => 'Project timelines vary based on scope. Small projects may take 1-2 weeks, while larger projects can take 4-8 weeks.', 'order' => 2]);
        Faq::create(['question' => 'Do you offer maintenance services?', 'answer' => 'Yes, we offer comprehensive landscape maintenance packages to keep your outdoor spaces looking beautiful year-round.', 'order' => 3]);

        // Default Settings
        $settings = [
            ['key' => 'site_name', 'value' => 'Ecoscapes Landscaping Pvt Ltd', 'group' => 'general'],
            ['key' => 'meta_title', 'value' => 'Ecoscapes - Professional Landscaping Services', 'group' => 'general'],
            ['key' => 'meta_description', 'value' => 'Professional landscaping services in Bangalore. Landscape design, execution, and maintenance.', 'group' => 'general'],
            ['key' => 'footer_description', 'value' => '3rd floor, Thanks Court, 3rd B Main Road, Near 4th Cross Ring, Thillai Nagar 2nd Block, Kalyan Nagar, Bengaluru, Bangalore 560043', 'group' => 'footer'],
            ['key' => 'copyright_text', 'value' => 'Copyright 2025 Ecoscapes All rights reserved.', 'group' => 'footer'],
            ['key' => 'facebook', 'value' => 'https://facebook.com/ecoscapes', 'group' => 'footer'],
            ['key' => 'instagram', 'value' => 'https://instagram.com/ecoscapes', 'group' => 'footer'],
            ['key' => 'linkedin', 'value' => 'https://linkedin.com/company/ecoscapes', 'group' => 'footer'],
            ['key' => 'phone', 'value' => '+91-85522-22990', 'group' => 'contact'],
            ['key' => 'email', 'value' => 'info@ecoscapes.in', 'group' => 'contact'],
            ['key' => 'address', 'value' => '3rd floor, Thanks Court, 3rd B Main Road, Kalyan Nagar, Bengaluru, Karnataka - 560043', 'group' => 'contact'],
            ['key' => 'google_map_url', 'value' => '', 'group' => 'contact'],
            ['key' => 'happy_clients', 'value' => '300', 'group' => 'stats'],
            ['key' => 'completed_projects', 'value' => '400', 'group' => 'stats'],
            ['key' => 'trees_planted', 'value' => '5000', 'group' => 'stats'],
            ['key' => 'years_experience', 'value' => '14', 'group' => 'stats'],
            ['key' => 'professionals', 'value' => '18', 'group' => 'stats'],
            ['key' => 'gardeners', 'value' => '120', 'group' => 'stats'],
        ];

        foreach ($settings as $setting) {
            Setting::create($setting);
        }
    }
}
