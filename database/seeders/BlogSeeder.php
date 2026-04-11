<?php

namespace Database\Seeders;

use App\Models\Blog;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        $blogs = [
            [
                'title' => 'Top 10 Low-Maintenance Plants for Bangalore Gardens',
                'excerpt' => 'Discover the best plants that thrive in Bangalore\'s climate with minimal care. From Bougainvillea to Plumeria, these hardy species are perfect for busy homeowners.',
                'content' => '<p>Bangalore\'s moderate climate makes it an ideal location for a wide variety of plants. Whether you have a sprawling garden or a compact balcony, choosing low-maintenance plants can help you enjoy lush greenery without spending hours on upkeep.</p><h3>1. Bougainvillea</h3><p>This vibrant flowering plant thrives in Bangalore\'s sunny weather and requires minimal watering once established. Available in stunning shades of pink, purple, orange, and white.</p><h3>2. Plumeria (Frangipani)</h3><p>Known for its fragrant flowers and tropical appeal, Plumeria is drought-tolerant and grows well in Bangalore\'s warm climate.</p><h3>3. Hibiscus</h3><p>A classic garden staple, Hibiscus produces large, colorful blooms throughout the year. It\'s easy to grow and attracts butterflies and hummingbirds.</p><h3>4. Adenium (Desert Rose)</h3><p>This striking succulent produces beautiful flowers and requires very little water, making it perfect for low-maintenance gardens.</p><h3>5. Ixora</h3><p>A compact shrub that produces clusters of bright flowers year-round. Ixora is excellent for borders and hedges.</p><h3>6. Duranta</h3><p>With its cascading purple flowers and golden berries, Duranta adds color and texture to any garden. It\'s highly adaptable and easy to maintain.</p><h3>7. Crotons</h3><p>These colorful foliage plants add dramatic visual interest with their multi-colored leaves. They thrive in partial shade and require minimal care.</p><h3>8. Snake Plant (Sansevieria)</h3><p>One of the most resilient indoor-outdoor plants, Snake Plant purifies air and survives neglect remarkably well.</p><h3>9. Money Plant (Pothos)</h3><p>A versatile climber that grows in both soil and water. Perfect for balconies, walls, and indoor spaces.</p><h3>10. Jasmine</h3><p>Fragrant and beautiful, Jasmine is a must-have for Bangalore gardens. It blooms profusely during the warm months and requires moderate watering.</p><p>At SR Greenscapes, we help you choose the right plants for your specific location, soil type, and lifestyle. Contact us for a personalized garden consultation.</p>',
                'category' => 'Gardening Tips',
                'author' => 'Dr. Suresh Reddy',
                'image' => 'Home/1.17 Specialized Garden Services.jpg',
                'is_published' => true,
                'published_at' => now()->subDays(3),
            ],
            [
                'title' => 'The Science Behind Miyawaki Forests: How We Build Urban Jungles',
                'excerpt' => 'Learn how the Miyawaki method creates dense, native forests in urban spaces 10x faster than conventional methods. A scientific approach to urban greening.',
                'content' => '<p>The Miyawaki method, developed by Japanese botanist Akira Miyawaki, is a revolutionary technique for creating dense, biodiverse forests in urban areas. At SR Greenscapes, we\'ve successfully implemented this method across multiple projects in Bangalore.</p><h3>What is the Miyawaki Method?</h3><p>Unlike traditional plantation methods, the Miyawaki technique involves planting native species close together — typically 3 to 5 saplings per square meter. This dense planting encourages competition for sunlight, causing rapid vertical growth.</p><h3>Our Scientific Process</h3><p><strong>1. Soil Analysis:</strong> We begin with comprehensive soil testing to understand pH levels, nutrient content, and microbial activity. This data drives our soil amendment strategy.</p><p><strong>2. Native Species Selection:</strong> We identify 20-30 native species that naturally occur in the region. This ensures the forest is self-sustaining and supports local wildlife.</p><p><strong>3. Multi-Layer Planting:</strong> We plant in four distinct layers — shrub, sub-tree, tree, and canopy — mimicking natural forest structure.</p><p><strong>4. Soil Preparation:</strong> We amend the soil with organic matter, rice husk, coco peat, and beneficial microorganisms to create optimal growing conditions.</p><h3>Results</h3><p>Our Miyawaki forests typically show:</p><ul><li>Growth rates 10x faster than conventional plantations</li><li>30x denser vegetation</li><li>100% native and biodiverse ecosystems</li><li>Self-sustaining within 3 years</li></ul><p>Interested in creating a Miyawaki forest in your community? Contact SR Greenscapes for a site assessment.</p>',
                'category' => 'Sustainability',
                'author' => 'Arjun Nair',
                'image' => 'Home/1.9 Sustainability at the Core.jpg',
                'is_published' => true,
                'published_at' => now()->subDays(7),
            ],
            [
                'title' => 'Hardscape vs Softscape: Understanding the Balance in Landscape Design',
                'excerpt' => 'A well-designed landscape harmonizes hard elements like pathways and walls with soft elements like plants and lawns. Learn how to achieve the perfect balance.',
                'content' => '<p>Landscape design is an art that balances two fundamental elements: hardscape (non-living features) and softscape (living features). Understanding this balance is key to creating outdoor spaces that are both functional and beautiful.</p><h3>What is Hardscape?</h3><p>Hardscape refers to the solid, non-living elements in your landscape:</p><ul><li>Pathways and walkways</li><li>Patios and decks</li><li>Retaining walls</li><li>Water features and fountains</li><li>Outdoor kitchens and fire pits</li><li>Driveways and parking areas</li></ul><h3>What is Softscape?</h3><p>Softscape encompasses all living elements:</p><ul><li>Trees and shrubs</li><li>Flower beds and borders</li><li>Lawns and ground covers</li><li>Climbers and creepers</li><li>Herbs and vegetable gardens</li></ul><h3>Finding the Right Balance</h3><p>The ideal hardscape-to-softscape ratio depends on your space, climate, and usage needs. For residential properties in Bangalore, we typically recommend a 40:60 ratio (hardscape to softscape) to maximize greenery while maintaining functionality.</p><p>At SR Greenscapes, our design team uses 3D visualization tools to help you see exactly how your landscape will look before construction begins.</p>',
                'category' => 'Landscape Design',
                'author' => 'Priya Sharma',
                'image' => 'Home/1.18 Hardscape  Softscape Development.jpg',
                'is_published' => true,
                'published_at' => now()->subDays(12),
            ],
            [
                'title' => 'Terrace Garden Ideas: Transform Your Rooftop into a Green Paradise',
                'excerpt' => 'Turn your unused terrace into a productive garden with our expert tips on waterproofing, container selection, soil mix, and plant choices for rooftop gardens.',
                'content' => '<p>With urban spaces shrinking, terrace gardens have become increasingly popular in Bangalore. A well-planned rooftop garden can provide fresh vegetables, beautiful flowers, and a peaceful retreat right at your doorstep.</p><h3>Essential Steps for Terrace Gardening</h3><p><strong>1. Waterproofing:</strong> Before starting, ensure your terrace has proper waterproofing to prevent leakage. We recommend a multi-layer waterproofing system with drainage mats.</p><p><strong>2. Weight Assessment:</strong> Consult a structural engineer to determine how much weight your terrace can safely support. Lightweight containers and soil mixes help reduce the load.</p><p><strong>3. Container Selection:</strong> Choose containers based on the plants you want to grow. Deep containers for root vegetables, shallow ones for herbs, and raised beds for mixed plantings.</p><p><strong>4. Soil Mix:</strong> Use a lightweight growing medium — typically a mix of red soil, compost, cocopeat, and perlite in equal proportions.</p><h3>Best Plants for Bangalore Terraces</h3><ul><li>Vegetables: Tomatoes, chillies, brinjal, beans, greens</li><li>Herbs: Basil, mint, coriander, curry leaves</li><li>Flowers: Marigolds, petunias, geraniums</li><li>Fruits: Papaya, guava (dwarf varieties)</li></ul><p>SR Greenscapes offers complete terrace garden setup services, from waterproofing to automated drip irrigation installation.</p>',
                'category' => 'Gardening Tips',
                'author' => 'Kavitha Rao',
                'image' => 'Home/1.5 Cover photo 5.jpg',
                'is_published' => true,
                'published_at' => now()->subDays(18),
            ],
            [
                'title' => 'Corporate Landscaping: How Green Spaces Boost Employee Productivity',
                'excerpt' => 'Research shows that well-designed office landscapes increase productivity by 15% and reduce stress. Discover how corporate green spaces transform workplaces.',
                'content' => '<p>In today\'s competitive corporate world, companies are realizing that the physical work environment significantly impacts employee well-being and productivity. Research from the University of Exeter shows that offices with plants and green views increase productivity by up to 15%.</p><h3>Benefits of Corporate Landscaping</h3><p><strong>Reduced Stress:</strong> Studies show that exposure to greenery reduces cortisol levels by 12% and lowers blood pressure.</p><p><strong>Improved Air Quality:</strong> Indoor plants remove up to 87% of air toxins within 24 hours, creating a healthier work environment.</p><p><strong>Enhanced Creativity:</strong> Natural elements in the workplace stimulate creative thinking and problem-solving abilities.</p><p><strong>Talent Attraction:</strong> 76% of job seekers consider the physical work environment when evaluating potential employers.</p><h3>Our Corporate Solutions</h3><p>At SR Greenscapes, we provide comprehensive corporate landscaping solutions:</p><ul><li>Campus landscape design and execution</li><li>Indoor plant installations and green walls</li><li>Rooftop gardens and employee break areas</li><li>Annual maintenance contracts (AMC)</li><li>Seasonal planting and event decoration</li></ul><p>We\'ve transformed corporate campuses across Bangalore, including IT parks, manufacturing facilities, and co-working spaces.</p>',
                'category' => 'Industry Insights',
                'author' => 'Dr. Suresh Reddy',
                'image' => 'Home/1.12 End-to-End Execution.jpg',
                'is_published' => true,
                'published_at' => now()->subDays(25),
            ],
            [
                'title' => 'Seasonal Plant Care Guide: Preparing Your Garden for Bangalore Monsoon',
                'excerpt' => 'Monsoon brings both opportunities and challenges for gardeners. Learn essential tips to protect your plants, manage drainage, and leverage the rainy season for growth.',
                'content' => '<p>Bangalore\'s monsoon season (June to September) is a critical time for gardens. While the rains bring much-needed moisture, excessive water can cause root rot, fungal infections, and soil erosion if not managed properly.</p><h3>Pre-Monsoon Preparation</h3><p><strong>Drainage Check:</strong> Ensure all garden beds have proper drainage. Add gravel at the base of pots and clear blocked drain holes.</p><p><strong>Pruning:</strong> Trim overgrown plants to improve air circulation and reduce the risk of fungal diseases.</p><p><strong>Soil Amendment:</strong> Add compost and neem cake to strengthen plants before the monsoon stress period.</p><h3>During Monsoon</h3><p><strong>Avoid Overwatering:</strong> Let the rain do the work. Check soil moisture before watering — most plants won\'t need additional water during active rain periods.</p><p><strong>Watch for Pests:</strong> Slugs, snails, and fungal diseases increase during monsoon. Use organic neem oil spray as a preventive measure.</p><p><strong>Support Tall Plants:</strong> Stake tall plants and climbers to prevent wind damage during heavy storms.</p><h3>Best Plants to Plant During Monsoon</h3><ul><li>Trees: Neem, Tabebuia, Pongamia</li><li>Shrubs: Ixora, Mussaenda, Hibiscus</li><li>Ground Covers: Lantana, Ruellia</li></ul><p>Need help preparing your garden for monsoon? SR Greenscapes offers seasonal maintenance packages.</p>',
                'category' => 'Gardening Tips',
                'author' => 'Rajesh Kumar',
                'image' => 'Home/1.8 Science-Driven Approach.jpg',
                'is_published' => true,
                'published_at' => now()->subDays(30),
            ],
        ];

        foreach ($blogs as $blog) {
            $blog['slug'] = Str::slug($blog['title']);
            Blog::create($blog);
        }
    }
}
