<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;
use Illuminate\Support\Str;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'name' => 'Landscape Design & Execution',
                'description' => '<p>Our comprehensive landscape design and execution service transforms outdoor spaces into stunning, functional environments. We combine scientific soil analysis, climate assessment, and aesthetic planning to create landscapes that thrive year-round.</p><p>From concept sketches to final installation, our team handles every aspect including grading, planting, hardscape integration, and irrigation setup.</p>',
                'image' => 'Home/1.16 Landscape Design  Execution.png',
                'icon' => 'fas fa-drafting-compass',
            ],
            [
                'name' => 'Specialized Garden Services',
                'description' => '<p>From Miyawaki forests and vertical gardens to terrace gardens and rooftop green spaces, we create specialized garden solutions tailored to unique requirements. Our expertise covers Japanese gardens, butterfly gardens, medicinal herb gardens, and more.</p><p>Each specialized garden is designed with specific ecological goals in mind, whether it\'s biodiversity enhancement, air purification, or creating therapeutic green spaces.</p>',
                'image' => 'Home/1.17 Specialized Garden Services.jpg',
                'icon' => 'fas fa-spa',
            ],
            [
                'name' => 'Hardscape & Softscape Development',
                'description' => '<p>We create the perfect balance between hardscape elements (pathways, patios, retaining walls, water features) and softscape elements (plants, trees, lawns, flower beds). Our integrated approach ensures structural durability and natural beauty work in harmony.</p><p>Using premium materials and native plant species, we build landscapes that are both visually striking and environmentally responsible.</p>',
                'image' => 'Home/1.18 Hardscape  Softscape Development.jpg',
                'icon' => 'fas fa-layer-group',
            ],
            [
                'name' => 'Landscape Maintenance',
                'description' => '<p>Keep your landscapes pristine year-round with our comprehensive maintenance service. Our trained gardeners handle regular mowing, pruning, fertilizing, pest management, irrigation maintenance, and seasonal planting.</p><p>We offer flexible plans — monthly, quarterly, or annual — tailored to the size and complexity of your landscape.</p>',
                'image' => 'Home/1.19 Landscape Maintenance.png',
                'icon' => 'fas fa-tools',
            ],
            [
                'name' => 'Nursery & Plant Supply',
                'description' => '<p>Our well-stocked nursery provides a wide range of indoor and outdoor plants, ornamental trees, flowering shrubs, ground covers, and seasonal plants. We source and grow plants suited to local climate conditions for maximum survival rates.</p><p>We also offer bulk supply for landscaping projects, corporate gifting, and event decoration.</p>',
                'image' => 'Home/1.20 Nursery  Plant Supply.jpg',
                'icon' => 'fas fa-seedling',
            ],
            [
                'name' => 'Horticulture Consultancy',
                'description' => '<p>Our certified horticulture consultants provide expert advice on plant health, soil management, pest control, and landscape optimization. We conduct site assessments and deliver actionable recommendations for both new and existing green spaces.</p><p>Services include soil testing, plant disease diagnosis, irrigation audit, and seasonal maintenance planning.</p>',
                'image' => 'Home/1.21 Horticulture Consultancy.png',
                'icon' => 'fas fa-microscope',
            ],
            [
                'name' => 'Garden Supplies',
                'description' => '<p>Browse our extensive range of garden supplies including premium soil mixes, organic fertilizers, gardening tools, pots and planters, seeds, and plant care products. Everything you need to create and maintain a beautiful garden.</p><p>We stock professional-grade supplies suited for both home gardeners and commercial landscaping projects.</p>',
                'image' => 'Home/1.15 Cost-Effective  Affordable.jpg',
                'icon' => 'fas fa-store',
            ],
            [
                'name' => 'Green Gifts',
                'description' => '<p>Explore our curated collection of green gifts perfect for any occasion — birthdays, housewarmings, corporate gifting, and festive celebrations. Choose from beautifully potted plants, succulent arrangements, terrarium kits, and custom plant hampers.</p><p>Each gift is thoughtfully packaged with care instructions. We also offer bulk corporate gifting solutions with custom branding options.</p>',
                'image' => 'Home/1.22 Green Gifts.png',
                'icon' => 'fas fa-gift',
            ],
            [
                'name' => 'Event Styling',
                'description' => '<p>Add a touch of natural elegance to your events with our green styling and floral decoration services. We design and install living green walls, floral arches, table centerpieces, and thematic plant arrangements for weddings, corporate events, and exhibitions.</p><p>Our eco-friendly approach uses live plants and sustainable materials, creating memorable experiences while minimizing environmental impact.</p>',
                'image' => 'Home/1.23 Event Styling.jpg',
                'icon' => 'fas fa-palette',
            ],
        ];

        foreach ($services as $i => $svc) {
            Service::create([
                'name' => $svc['name'],
                'slug' => Str::slug($svc['name']),
                'description' => $svc['description'],
                'image' => $svc['image'],
                'icon' => $svc['icon'],
                'category' => 'design',
                'is_active' => true,
                'order' => $i + 1,
            ]);
        }
    }
}
