<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        Faq::where('category', '!=', 'Home Page')->delete();

        $faqs = [
            // About Us
            ['category' => 'About Us', 'question' => 'What is SR Greenscapes Pvt Ltd?', 'answer' => 'SR Greenscapes Pvt Ltd is a sustainable landscaping company based in Bengaluru, providing research-integrated landscape, nursery, horticulture and ecological solutions across India.'],
            ['category' => 'About Us', 'question' => 'How are you different from other landscaping companies?', 'answer' => 'We integrate scientific planning, soil assessment, climate-responsive plant selection and sustainability principles into every project. Our approach focuses on long-term ecological performance rather than short-term aesthetics.'],
            ['category' => 'About Us', 'question' => 'Do you promote native and climate-resilient plants?', 'answer' => 'Yes. We prioritize native and adaptive species that support biodiversity, reduce water use, and improve long-term sustainability.'],
            ['category' => 'About Us', 'question' => 'Do you handle institutional or government landscape projects?', 'answer' => 'Yes. We undertake institutional, campus and public-sector projects with structured planning, documentation and professional execution standards.'],
            ['category' => 'About Us', 'question' => 'Where do you operate?', 'answer' => 'Headquartered in Bengaluru, we deliver projects across India.'],

            // Services & Projects
            ['category' => 'Services & Projects', 'question' => 'What types of projects do you handle?', 'answer' => 'Homes, villas, apartments, offices, resorts, hospitals, schools, corporate campuses, parks, and public landscapes.'],
            ['category' => 'Services & Projects', 'question' => 'What services do you offer?', 'answer' => 'Landscape design & execution, softscape & hardscape, specialized garden services, maintenance, event styling, horticulture consultancy, nursery supply, irrigation, water features, and lighting.'],
            ['category' => 'Services & Projects', 'question' => 'Do you provide maintenance services?', 'answer' => 'Yes. We offer tailored maintenance plans including pruning, fertilization, pest control, irrigation and plant health monitoring.'],
            ['category' => 'Services & Projects', 'question' => 'Can you design temporary green décor for events?', 'answer' => 'Absolutely. We handle weddings, corporate events, exhibitions, festive occasions and themed green installations.'],

            // Consultation & Project Process
            ['category' => 'Consultation & Project Process', 'question' => 'How do I start a landscaping project?', 'answer' => 'Begin with a consultation via call, video chat, or on-site visit to discuss your space, needs, budget and maintenance expectations.'],
            ['category' => 'Consultation & Project Process', 'question' => 'Will I see the design before work begins?', 'answer' => 'Yes. We provide 2D drawings or 3D visualizations so you can clearly visualize the final result.'],
            ['category' => 'Consultation & Project Process', 'question' => 'How is the project executed?', 'answer' => 'Our team manages site preparation, hardscaping, planting, irrigation and lawn installation, keeping you updated throughout the process.'],
            ['category' => 'Consultation & Project Process', 'question' => 'Do you offer support after completion?', 'answer' => 'Yes. We provide a guided handover and optional post-completion support to keep your garden healthy and vibrant.'],

            // Landscape & Garden Design
            ['category' => 'Landscape & Garden Design', 'question' => 'Do you handle small gardens or terraces?', 'answer' => 'Yes. We specialize in small spaces, including balconies, terraces, courtyards and vertical gardens.'],
            ['category' => 'Landscape & Garden Design', 'question' => "What if I don't have measurements or a layout?", 'answer' => 'No problem. Our team can visit the site, take measurements and create a customized design.'],
            ['category' => 'Landscape & Garden Design', 'question' => 'How long does a garden design take?', 'answer' => 'Typically, 1–3 weeks for small gardens, depending on complexity.'],
            ['category' => 'Landscape & Garden Design', 'question' => 'Do you charge for consultation?', 'answer' => 'A nominal fee applies, which is adjusted if you proceed with the project.'],

            // Garden Maintenance & Irrigation
            ['category' => 'Garden Maintenance & Irrigation', 'question' => 'Do you provide regular garden maintenance?', 'answer' => "Yes. Weekly, bi-weekly, or monthly plans are available depending on your garden's needs."],
            ['category' => 'Garden Maintenance & Irrigation', 'question' => 'Can you service existing irrigation systems?', 'answer' => 'Yes. We install, repair and maintain all types of irrigation systems.'],
            ['category' => 'Garden Maintenance & Irrigation', 'question' => 'Do you provide garden installation outside Bengaluru or India?', 'answer' => 'Yes, for select locations across India.'],

            // Nursery & Plant Orders
            ['category' => 'Nursery & Plant Orders', 'question' => 'Do you ship plants outside Bengaluru?', 'answer' => 'Yes! Delivery is available to select locations, with charges varying by distance and plant type.'],
            ['category' => 'Nursery & Plant Orders', 'question' => 'Can I order soils or farmyard manure (FYM)?', 'answer' => 'Yes. We provide red soil, garden soil and FYM in convenient sacks.'],
            ['category' => 'Nursery & Plant Orders', 'question' => 'What if plants are damaged during delivery?', 'answer' => 'Contact us immediately. We offer replacement or refund for damaged plants.'],
            ['category' => 'Nursery & Plant Orders', 'question' => 'Can I request plants not listed in your nursery?', 'answer' => "Absolutely! Share the details and we'll try to source it for you."],

            // Team & Contact
            ['category' => 'Team & Contact', 'question' => 'Who is behind SR Greenscapes Pvt Ltd?', 'answer' => 'Our team includes PhD horticulture professionals, landscape designers, project managers, and skilled horticulture experts. MDs: Dr. Supriya Narayan & Mr. Srinidhi AT, supported by a strategic advisory panel.'],
            ['category' => 'Team & Contact', 'question' => 'How can I contact you?', 'answer' => "Phone / WhatsApp: +91 9845728507, +91 9113620609\nEmail: srgreenscapes@gmail.com, mdsrgreenscapes@gmail.com"],
            ['category' => 'Team & Contact', 'question' => 'Where is your office located?', 'answer' => 'Sy No. 32/40, Ground Floor, Jinnagara, Gangalu Main Road, Near Jinnagara Basaveshwara Temple, Hoskote Taluk, Bangalore – 562114, Karnataka, India'],
            ['category' => 'Team & Contact', 'question' => 'Are you open on Sundays?', 'answer' => 'Yes, we operate 24 × 7, ensuring uninterrupted service and support for our clients.'],
        ];

        foreach ($faqs as $i => $faq) {
            Faq::create(array_merge($faq, ['is_active' => true, 'order' => $i + 1]));
        }
    }
}
