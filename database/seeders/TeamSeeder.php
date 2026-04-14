<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TeamCategory;
use App\Models\TeamMember;

class TeamSeeder extends Seeder
{
    public function run(): void
    {
        // ===== TEAM CATEGORIES =====
        $managingDirectors = TeamCategory::create([
            'name' => 'Managing Directors',
            'slug' => 'managing-directors',
            'is_active' => true,
            'order' => 1,
        ]);

        $advisoryPanel = TeamCategory::create([
            'name' => 'Strategic Advisory Panel',
            'slug' => 'strategic-advisory-panel',
            'is_active' => true,
            'order' => 2,
        ]);

        $coreTeam = TeamCategory::create([
            'name' => 'Core Team',
            'slug' => 'core-team',
            'is_active' => true,
            'order' => 3,
        ]);

        // ===== MANAGING DIRECTORS =====
        TeamMember::create([
            'name' => 'Dr. Supriya Narayan, PhD (Horticulture)',
            'role' => 'Managing Director',
            'bio' => 'Leading GreenEdge\'s vision for sustainable landscape solutions.',
            'photo' => null,
            'team_category_id' => $managingDirectors->id,
            'is_active' => true,
            'order' => 1,
        ]);

        TeamMember::create([
            'name' => 'Mr. Srinidhi AT, B.Com',
            'role' => 'Managing Director',
            'bio' => 'Driving strategic planning and seamless project execution.',
            'photo' => null,
            'team_category_id' => $managingDirectors->id,
            'is_active' => true,
            'order' => 2,
        ]);

        // ===== STRATEGIC ADVISORY PANEL =====
        TeamMember::create([
            'name' => 'Dr. V. Nachegowda',
            'role' => 'Strategic Advisor',
            'photo' => null,
            'team_category_id' => $advisoryPanel->id,
            'is_active' => true,
            'order' => 1,
        ]);

        TeamMember::create([
            'name' => 'Dr. M. Chandregowda',
            'role' => 'Strategic Advisor',
            'photo' => null,
            'team_category_id' => $advisoryPanel->id,
            'is_active' => true,
            'order' => 2,
        ]);

        TeamMember::create([
            'name' => 'Dr. P. Narayanaswamy',
            'role' => 'Strategic Advisor',
            'photo' => null,
            'team_category_id' => $advisoryPanel->id,
            'is_active' => true,
            'order' => 3,
        ]);

        TeamMember::create([
            'name' => 'Dr. T. Ranguswamy',
            'role' => 'Strategic Advisor',
            'photo' => null,
            'team_category_id' => $advisoryPanel->id,
            'is_active' => true,
            'order' => 4,
        ]);

        // ===== CORE TEAM =====
        TeamMember::create([
            'name' => 'Sanjay K',
            'role' => 'Horticulture Consultant',
            'bio' => 'Landscape & horticulture growth.',
            'photo' => null,
            'team_category_id' => $coreTeam->id,
            'is_active' => true,
            'order' => 1,
        ]);

        TeamMember::create([
            'name' => 'Mrs. Pavithra K S',
            'role' => 'Marketing & Biz Dev',
            'bio' => 'Driving brand & outreach.',
            'photo' => null,
            'team_category_id' => $coreTeam->id,
            'is_active' => true,
            'order' => 2,
        ]);

        TeamMember::create([
            'name' => 'Mrs. Vindya R',
            'role' => 'Accounts/Finance',
            'bio' => 'Managing finance & administration.',
            'photo' => null,
            'team_category_id' => $coreTeam->id,
            'is_active' => true,
            'order' => 3,
        ]);

        TeamMember::create([
            'name' => 'Mr. Keshav M B',
            'role' => 'Project Manager',
            'bio' => 'Ensuring project delivery.',
            'photo' => null,
            'team_category_id' => $coreTeam->id,
            'is_active' => true,
            'order' => 4,
        ]);

        TeamMember::create([
            'name' => 'Mr. Mahima MR',
            'role' => 'Site Operations',
            'bio' => 'Site operations & quality control.',
            'photo' => null,
            'team_category_id' => $coreTeam->id,
            'is_active' => true,
            'order' => 5,
        ]);

        TeamMember::create([
            'name' => 'Mr. Venkatesh P V',
            'role' => 'Field Supervisor',
            'bio' => 'Maintenance & quality.',
            'photo' => null,
            'team_category_id' => $coreTeam->id,
            'is_active' => true,
            'order' => 6,
        ]);
    }
}
