<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ServiceCategory;
use App\Models\ServiceSubCategory;
use App\Models\Service;
use Illuminate\Support\Str;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        // ===== SERVICE CATEGORIES =====
        $landscaping = ServiceCategory::create([
            'name' => 'Landscaping Services',
            'slug' => 'landscaping-services',
            'image' => 'Home/1.16 Landscape Design  Execution.png',
            'is_active' => true,
            'order' => 1,
        ]);

        $garden = ServiceCategory::create([
            'name' => 'Garden & Nursery',
            'slug' => 'garden-nursery',
            'image' => 'Home/1.20 Nursery  Plant Supply.jpg',
            'is_active' => true,
            'order' => 2,
        ]);

        $maintenance = ServiceCategory::create([
            'name' => 'Maintenance & Support',
            'slug' => 'maintenance-support',
            'image' => 'Home/1.19 Landscape Maintenance.png',
            'is_active' => true,
            'order' => 3,
        ]);

        // ===== SUB CATEGORIES =====
        $residential = ServiceSubCategory::create([
            'service_category_id' => $landscaping->id,
            'name' => 'Residential Landscaping',
            'slug' => 'residential-landscaping',
            'is_active' => true,
            'order' => 1,
        ]);

        $commercial = ServiceSubCategory::create([
            'service_category_id' => $landscaping->id,
            'name' => 'Commercial Landscaping',
            'slug' => 'commercial-landscaping',
            'is_active' => true,
            'order' => 2,
        ]);

        $nursery = ServiceSubCategory::create([
            'service_category_id' => $garden->id,
            'name' => 'Nursery & Plant Supply',
            'slug' => 'nursery-plant-supply',
            'is_active' => true,
            'order' => 1,
        ]);

        $specialized = ServiceSubCategory::create([
            'service_category_id' => $garden->id,
            'name' => 'Specialized Gardens',
            'slug' => 'specialized-gardens',
            'is_active' => true,
            'order' => 2,
        ]);

        $amc = ServiceSubCategory::create([
            'service_category_id' => $maintenance->id,
            'name' => 'Annual Maintenance (AMC)',
            'slug' => 'annual-maintenance',
            'is_active' => true,
            'order' => 1,
        ]);

        // ===== SERVICES =====
        $services = [
            [
                'name' => 'Landscape Design & Execution',
                'description' => '<p>Our comprehensive landscape design and execution service transforms outdoor spaces into stunning, functional environments. We combine scientific soil analysis, climate assessment, and aesthetic planning to create landscapes that thrive year-round.</p><p>From concept sketches to final installation, our team handles every aspect including grading, planting, hardscape integration, and irrigation setup. We specialize in creating sustainable designs that minimize water usage while maximizing visual impact.</p>',
                'image' => 'Home/1.16 Landscape Design  Execution.png',
                'icon' => 'fas fa-drafting-compass',
                'category' => 'design',
                'service_category_id' => $landscaping->id,
                'service_sub_category_id' => $residential->id,
                'order' => 1,
            ],
            [
                'name' => 'Hardscape & Softscape Development',
                'description' => '<p>We create the perfect balance between hardscape elements (pathways, patios, retaining walls, water features) and softscape elements (plants, trees, lawns, flower beds). Our integrated approach ensures structural durability and natural beauty work in harmony.</p><p>Using premium materials and native plant species, we build landscapes that are both visually striking and environmentally responsible. Every project is customized to suit the site conditions and client preferences.</p>',
                'image' => 'Home/1.18 Hardscape  Softscape Development.jpg',
                'icon' => 'fas fa-layer-group',
                'category' => 'design',
                'service_category_id' => $landscaping->id,
                'service_sub_category_id' => $residential->id,
                'order' => 2,
            ],
            [
                'name' => 'Commercial Campus Landscaping',
                'description' => '<p>Transform your corporate campus, office parks, and commercial properties with professional landscaping that creates welcoming environments for employees and visitors. We design green spaces that enhance productivity and corporate image.</p><p>Our commercial projects include entrance beautification, parking lot landscaping, courtyard gardens, and rooftop green spaces. We work within project timelines and budgets to deliver exceptional results.</p>',
                'image' => 'Home/1.2 Cover photo 2.jpg',
                'icon' => 'fas fa-building',
                'category' => 'design',
                'service_category_id' => $landscaping->id,
                'service_sub_category_id' => $commercial->id,
                'order' => 3,
            ],
            [
                'name' => 'Specialized Garden Services',
                'description' => '<p>From Miyawaki forests and vertical gardens to terrace gardens and rooftop green spaces, we create specialized garden solutions tailored to unique requirements. Our expertise covers Japanese gardens, butterfly gardens, medicinal herb gardens, and more.</p><p>Each specialized garden is designed with specific ecological goals in mind, whether it\'s biodiversity enhancement, air purification, or creating therapeutic green spaces for wellness centers and hospitals.</p>',
                'image' => 'Home/1.17 Specialized Garden Services.jpg',
                'icon' => 'fas fa-spa',
                'category' => 'design',
                'service_category_id' => $garden->id,
                'service_sub_category_id' => $specialized->id,
                'order' => 4,
            ],
            [
                'name' => 'Nursery & Plant Supply',
                'description' => '<p>Our well-stocked nursery provides a wide range of indoor and outdoor plants, ornamental trees, flowering shrubs, ground covers, and seasonal plants. We source and grow plants suited to local climate conditions for maximum survival rates.</p><p>We also offer bulk supply for landscaping projects, corporate gifting, and event decoration. Our horticulture experts provide guidance on plant selection, care, and placement for optimal growth.</p>',
                'image' => 'Home/1.20 Nursery  Plant Supply.jpg',
                'icon' => 'fas fa-seedling',
                'category' => 'maintenance',
                'service_category_id' => $garden->id,
                'service_sub_category_id' => $nursery->id,
                'order' => 5,
            ],
            [
                'name' => 'Horticulture Consultancy',
                'description' => '<p>Our certified horticulture consultants provide expert advice on plant health, soil management, pest control, and landscape optimization. We conduct site assessments and deliver actionable recommendations for both new and existing green spaces.</p><p>Services include soil testing, plant disease diagnosis, irrigation audit, and seasonal maintenance planning. Ideal for property managers, housing societies, and institutional campuses.</p>',
                'image' => 'Home/1.21 Horticulture Consultancy.png',
                'icon' => 'fas fa-microscope',
                'category' => 'maintenance',
                'service_category_id' => $garden->id,
                'service_sub_category_id' => $nursery->id,
                'order' => 6,
            ],
            [
                'name' => 'Landscape Maintenance (AMC)',
                'description' => '<p>Keep your landscapes pristine year-round with our Annual Maintenance Contract (AMC) service. Our trained gardeners handle regular mowing, pruning, fertilizing, pest management, irrigation maintenance, and seasonal planting.</p><p>We offer flexible plans — monthly, quarterly, or annual — tailored to the size and complexity of your landscape. Our proactive approach prevents issues before they arise, ensuring your green spaces always look their best.</p>',
                'image' => 'Home/1.19 Landscape Maintenance.png',
                'icon' => 'fas fa-tools',
                'category' => 'maintenance',
                'service_category_id' => $maintenance->id,
                'service_sub_category_id' => $amc->id,
                'order' => 7,
            ],
            [
                'name' => 'Event Styling & Green Decor',
                'description' => '<p>Add a touch of natural elegance to your events with our green styling and floral decoration services. We design and install living green walls, floral arches, table centerpieces, and thematic plant arrangements for weddings, corporate events, and exhibitions.</p><p>Our eco-friendly approach uses live plants and sustainable materials, creating memorable experiences while minimizing environmental impact. Post-event, plants are repurposed or returned to our nursery.</p>',
                'image' => 'Home/1.23 Event Styling.jpg',
                'icon' => 'fas fa-palette',
                'category' => 'design',
                'service_category_id' => $maintenance->id,
                'service_sub_category_id' => $amc->id,
                'order' => 8,
            ],
        ];

        foreach ($services as $svc) {
            Service::create(array_merge($svc, [
                'slug' => Str::slug($svc['name']),
                'is_active' => true,
            ]));
        }
    }
}
