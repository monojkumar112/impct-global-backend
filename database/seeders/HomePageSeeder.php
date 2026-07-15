<?php

namespace Database\Seeders;

use App\Models\HomePage;
use Illuminate\Database\Seeder;

class HomePageSeeder extends Seeder
{
    public function run(): void
    {
        HomePage::query()->updateOrCreate(
            ['id' => 1],
            [
                'hero_badge' => 'Boutique advisory for African market growth',
                'hero_title' => 'Expand across Sub-Saharan Africa with confidence.',
                'hero_description' => 'Impact Afrique Global Partners helps digital infrastructure, connectivity, mobility, and green energy organisations navigate market-entry, policy, regulatory, and stakeholder complexity across African markets.',
                'hero_tagline' => 'Partner-led access. Co-created strategy. Market-informed execution.',
                'hero_primary_btn_text' => 'Book an introductory conversation',
                'hero_primary_btn_link' => '#contact',
                'hero_secondary_btn_text' => 'Explore our advisory services',
                'hero_secondary_btn_link' => '#services',
                'hero_map_label' => 'Priority market network',
                'hero_priorities' => [
                    ['label' => 'Market entry', 'value' => 'Strategy'],
                    ['label' => 'Regulatory pathways', 'value' => 'Navigation'],
                    ['label' => 'Stakeholder access', 'value' => 'Engagement'],
                ],
                'hero_image' => null,
                'who_title' => 'Who We Are',
                'who_description' => 'Impact Afrique Global Partners is a boutique advisory firm helping companies and governments to design and scale sustainable, inclusive digital, connectivity, and energy infrastructure across Sub‑Saharan Africa.Our starting point It was built out of over 2 decades working with and inside African institutions, global development programmes, and corporations in over 25 countries . We understand how policy priorities, fiscal constraints, and political timelines shape what is possible on the ground. That lived experience sits at the heart of how we work with every client.',
                'who_btn_text' => 'Learn More',
                'who_btn_link' => '/about',
                'who_image' => null,
                'story_label' => 'Our Story',
                'story_title' => "Why We Started\nImpact Afrique",
                'story_description' => 'Impact Afrique Global Partners is a premier strategic advisory firm specializing in navigating complex business landscape. We transform regulatory challenges into competitive',
                'story_features' => [
                    [
                        'icon' => 'users',
                        'title' => 'Lived African Market Experience',
                        'description' => 'We transform regulatory challenges into competitive advantages.',
                    ],
                    [
                        'icon' => 'chart-bar',
                        'title' => 'Evidence-Based Policy Insights',
                        'description' => 'We transform regulatory challenges into competitive advantages.',
                    ],
                    [
                        'icon' => 'globe',
                        'title' => 'Strategic Global Perspective',
                        'description' => 'We transform regulatory challenges into competitive advantages.',
                    ],
                ],
                'story_btn_text' => 'LEARN MORE',
                'story_btn_link' => '/about',
                'story_image' => null,
                'story_quote' => 'We believe Africa deserves strategies built on understanding, not assumptions.',
                'story_quote_author' => '– Impact Afrique Global Partners',
                'why_title' => 'Why clients choose us',
                'why_description' => 'Our value lies in translating African market complexity into clearer decisions, stronger positioning, and more credible routes to execution.',
                'why_items' => [
                    [
                        'num' => 'A',
                        'title' => 'Regional insight',
                        'description' => 'Grounded understanding of market dynamics across Sub-Saharan Africa.',
                    ],
                    [
                        'num' => 'B',
                        'title' => 'Partner-led access',
                        'description' => 'Trusted pathways into stakeholder and ecosystem conversations that matter.',
                    ],
                    [
                        'num' => 'C',
                        'title' => 'Co-created strategy',
                        'description' => 'Practical advisory support shaped with clients, not handed over as static reports.',
                    ],
                    [
                        'num' => 'D',
                        'title' => 'Agile delivery',
                        'description' => 'Lean structures that can move quickly, adapt to context, and stay close to execution realities.',
                    ],
                ],
                'join_badge' => 'Start the conversation',
                'join_title' => 'Looking at expansion, policy navigation, or stakeholder strategy in Africa?',
                'join_description' => 'Start with a focused conversation about your priorities, target markets, and the risks or opportunities shaping your next move.',
                'join_primary_btn_text' => 'Book an introductory conversation',
                'join_primary_btn_link' => 'mailto:info@impactafriqueglobal.com',
                'join_secondary_btn_text' => 'Contact us',
                'join_secondary_btn_link' => '/contact',
            ]
        );
    }
}
