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
                'title' => 'Supporting Green Energy Transition',
                'slug' => 'supporting-green-energy-transition',
                'author' => 'Impact Afrique Global Partners',
                'excerpt' => 'We help digital infrastructure, connectivity, mobility and green energy organisations navigate market-entry, policy, regulatory, and stakeholder complexity across African markets.',
                'content' => '<p>Impact Afrique Global Partners supports organisations seeking to enter and grow across African green energy and technology markets.</p><p>Our advisory work spans market intelligence, policy engagement, stakeholder mapping, and partnership development tailored to local contexts.</p>',
                'custom_href' => '/blog/supporting-green-energy-transition',
                'published_at' => now()->subDays(2),
            ],
            [
                'title' => "Accelerating Africa's Electric Mobility Transition",
                'slug' => 'electrical-vehicle-solution',
                'author' => 'Impact Afrique Global Partners',
                'excerpt' => "Africa is entering a new era of mobility. As governments strengthen climate commitments and businesses seek cleaner transport solutions, electric vehicles are becoming an increasingly important part of the continent's economic future.",
                'content' => '<p>The global shift towards electric mobility is accelerating across Africa, creating opportunities in passenger EVs, fleet electrification, charging infrastructure, and battery technologies.</p><p>Impact Afrique Global Partners helps international businesses navigate market entry, policy frameworks, and local partnerships to build sustainable mobility ecosystems.</p>',
                'custom_href' => '/blog/electrical-vehicle-solution',
                'published_at' => now()->subDay(),
            ],
            [
                'title' => 'Driving African market growth through strategic partnerships',
                'slug' => 'driving-african-market-growth',
                'author' => 'Amina Kouyate',
                'excerpt' => 'How strategic partnerships unlock new market opportunities across Africa.',
                'content' => '<p>Impact Afrique Global Partners helps businesses and investors form the right partnerships with local stakeholders, navigating both regulatory and cultural landscapes.</p><p>Our approach focuses on evidence-driven policy, market entry support, and stakeholder alignment to accelerate growth in African economies.</p>',
                'published_at' => now()->subDays(6),
            ],
            [
                'title' => 'Building sustainable investments for resilient economies',
                'slug' => 'building-sustainable-investments',
                'author' => 'Samuel Ndlovu',
                'excerpt' => 'Sustainable investment frameworks that strengthen long-term value in African markets.',
                'content' => '<p>Sustainability is central to investment success across the continent, combining economic, social, and environmental goals.</p><p>We work with partners to align investment strategies with local development priorities and regulatory requirements.</p>',
                'published_at' => now()->subDays(7),
            ],
        ];

        foreach ($blogs as $blog) {
            Blog::updateOrCreate(
                ['slug' => $blog['slug']],
                array_merge($blog, ['status' => true])
            );
        }
    }
}
