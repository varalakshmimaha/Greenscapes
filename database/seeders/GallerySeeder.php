<?php

namespace Database\Seeders;

use App\Models\Gallery;
use Illuminate\Database\Seeder;

class GallerySeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'title' => 'Residential Garden Design',
                'image' => 'Home/1.16 Landscape Design  Execution.png',
                'category' => 'Landscaping',
                'description' => 'Beautiful residential garden with native plant species and stone pathways.',
                'is_active' => true,
                'order' => 1,
            ],
            [
                'title' => 'Hardscape Pathway',
                'image' => 'Home/1.18 Hardscape  Softscape Development.jpg',
                'category' => 'Hardscape',
                'description' => 'Natural stone pathway with softscape borders for a villa project.',
                'is_active' => true,
                'order' => 2,
            ],
            [
                'title' => 'Specialized Garden Setup',
                'image' => 'Home/1.17 Specialized Garden Services.jpg',
                'category' => 'Gardens',
                'description' => 'Specialized therapeutic garden designed for a wellness center.',
                'is_active' => true,
                'order' => 3,
            ],
            [
                'title' => 'Nursery Plant Collection',
                'image' => 'Home/1.20 Nursery  Plant Supply.jpg',
                'category' => 'Nursery',
                'description' => 'Our extensive nursery with over 500 varieties of native and exotic plants.',
                'is_active' => true,
                'order' => 4,
            ],
            [
                'title' => 'Landscape Maintenance',
                'image' => 'Home/1.19 Landscape Maintenance.png',
                'category' => 'Maintenance',
                'description' => 'Regular maintenance services keeping corporate campus landscapes pristine.',
                'is_active' => true,
                'order' => 5,
            ],
            [
                'title' => 'Horticulture Consultancy',
                'image' => 'Home/1.21 Horticulture Consultancy.png',
                'category' => 'Consultancy',
                'description' => 'Expert horticulture consultation for sustainable landscape planning.',
                'is_active' => true,
                'order' => 6,
            ],
            [
                'title' => 'Green Event Styling',
                'image' => 'Home/1.23 Event Styling.jpg',
                'category' => 'Events',
                'description' => 'Elegant green decor and plant styling for corporate and social events.',
                'is_active' => true,
                'order' => 7,
            ],
            [
                'title' => 'Green Gift Hampers',
                'image' => 'Home/1.22 Green Gifts.png',
                'category' => 'Gifts',
                'description' => 'Curated plant gift hampers for corporate gifting and special occasions.',
                'is_active' => true,
                'order' => 8,
            ],
            [
                'title' => 'Campus Green Cover',
                'image' => 'Home/1.12 End-to-End Execution.jpg',
                'category' => 'Landscaping',
                'description' => 'Complete campus greening project for a technology park in Bangalore.',
                'is_active' => true,
                'order' => 9,
            ],
            [
                'title' => 'Sustainable Landscape',
                'image' => 'Home/1.9 Sustainability at the Core.jpg',
                'category' => 'Landscaping',
                'description' => 'Climate-resilient landscape using drought-tolerant native species.',
                'is_active' => true,
                'order' => 10,
            ],
            [
                'title' => 'Research Garden',
                'image' => 'Home/1.10 Research-Integrated Planning.jpg',
                'category' => 'Gardens',
                'description' => 'Research-integrated garden with data-driven plant selection and monitoring.',
                'is_active' => true,
                'order' => 11,
            ],
            [
                'title' => 'Climate Resilient Planting',
                'image' => 'Home/1.11 Climate-Resilient Design.jpg',
                'category' => 'Landscaping',
                'description' => 'Heat and drought resistant landscape designed for urban environments.',
                'is_active' => true,
                'order' => 12,
            ],
        ];

        foreach ($items as $item) {
            Gallery::create($item);
        }
    }
}
