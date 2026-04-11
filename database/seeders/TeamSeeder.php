<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TeamCategory;
use App\Models\TeamMember;

class TeamSeeder extends Seeder
{
    public function run(): void
    {
        // Create Team Categories
        $leadership = TeamCategory::create([
            'name' => 'Leadership',
            'slug' => 'leadership',
            'is_active' => true,
            'order' => 1,
        ]);

        $design = TeamCategory::create([
            'name' => 'Design & Planning',
            'slug' => 'design-planning',
            'is_active' => true,
            'order' => 2,
        ]);

        $operations = TeamCategory::create([
            'name' => 'Operations',
            'slug' => 'operations',
            'is_active' => true,
            'order' => 3,
        ]);

        // Create Team Members
        TeamMember::create([
            'name' => 'Suresh Reddy',
            'role' => 'Founder & Managing Director',
            'bio' => 'With over 15 years of experience in sustainable landscaping, Suresh leads SR Greenscapes with a vision to transform outdoor spaces using science-driven approaches.',
            'photo' => 'Home/1.8 Science-Driven Approach.jpg',
            'facebook' => 'https://facebook.com',
            'linkedin' => 'https://www.linkedin.com/company/sr-greenscapes-pvt-ltd/',
            'instagram' => 'https://www.instagram.com/sr_greenscapes/',
            'is_active' => true,
            'order' => 1,
            'team_category_id' => $leadership->id,
        ]);

        TeamMember::create([
            'name' => 'Priya Sharma',
            'role' => 'Head of Operations',
            'bio' => 'Priya oversees all project operations, ensuring timely delivery and quality execution across all landscape projects.',
            'photo' => 'Home/1.9 Sustainability at the Core.jpg',
            'facebook' => 'https://facebook.com',
            'linkedin' => 'https://linkedin.com',
            'instagram' => 'https://instagram.com',
            'is_active' => true,
            'order' => 2,
            'team_category_id' => $leadership->id,
        ]);

        TeamMember::create([
            'name' => 'Arjun Nair',
            'role' => 'Senior Landscape Architect',
            'bio' => 'Arjun brings creative landscape designs to life with expertise in sustainable planning and innovative garden architecture.',
            'photo' => 'Home/1.10 Research-Integrated Planning.jpg',
            'facebook' => 'https://facebook.com',
            'linkedin' => 'https://linkedin.com',
            'instagram' => 'https://instagram.com',
            'is_active' => true,
            'order' => 3,
            'team_category_id' => $design->id,
        ]);

        TeamMember::create([
            'name' => 'Kavitha Rao',
            'role' => 'Horticulture Specialist',
            'bio' => 'Kavitha specializes in plant selection, soil analysis, and creating climate-resilient garden ecosystems for residential and commercial clients.',
            'photo' => 'Home/1.11 Climate-Resilient Design.jpg',
            'facebook' => 'https://facebook.com',
            'linkedin' => 'https://linkedin.com',
            'instagram' => 'https://instagram.com',
            'is_active' => true,
            'order' => 4,
            'team_category_id' => $design->id,
        ]);

        TeamMember::create([
            'name' => 'Rajesh Kumar',
            'role' => 'Project Manager',
            'bio' => 'Rajesh manages end-to-end project execution with expertise in hardscape development, irrigation systems, and landscape maintenance.',
            'photo' => 'Home/1.12 End-to-End Execution.jpg',
            'facebook' => 'https://facebook.com',
            'linkedin' => 'https://linkedin.com',
            'instagram' => 'https://instagram.com',
            'is_active' => true,
            'order' => 5,
            'team_category_id' => $operations->id,
        ]);
    }
}
