<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'title' => 'REGULATORY AND POLICY INSIGHTS',
                'description' => 'We plan, design and develop targeted research and insights for our clients to guide their investment, operations and expansion decisions into Sub-Saharan African countries. Our advisory teams support clients with research and evidence enabling smarter commercial decision-making and delivering practical, long-term solutions.',
            ],
            [
                'title' => 'STRATEGY DEVELOPMENT',
                'description' => 'We work alongside clients to develop country entry and growth strategies that connect organisational objectives with measurable outcomes. Our approach considers local market conditions, policy environments, regulatory frameworks, and political dynamics to create strategies that are both practical and achievable.',
            ],
            [
                'title' => 'POLICY FORMULATION AND SHAPING',
                'description' => 'We help clients develop and refine policy positions through rigorous analysis, testing, and evidence-based insights. By working closely with governments, regulators, and key stakeholders, we support the creation of informed policies that enable long-term impact and sustainable outcomes.',
            ],
            [
                'title' => 'STAKEHOLDER AND DECISION-MAKER ENGAGEMENT',
                'description' => 'We identify and engage the stakeholders who influence outcomes, building meaningful connections across public and private sectors. Through targeted engagement strategies, convenings, curation and thought leadership we help clients create alignment, gain support, secure approvals, and unlock strategic partnerships.',
            ],
            [
                'title' => 'ONGOING ADVISORY SUPPORT',
                'description' => 'We provide ongoing guidance such as horizon scanning, industry trends analysis, regulations, and political landscapes continue to evolve. By maintaining a proactive and adaptable approach, we help clients keep strategies relevant, responsive, and positioned for long-term success.',
            ],
        ];

        foreach ($services as $index => $service) {
            Service::updateOrCreate(
                ['title' => $service['title']],
                array_merge($service, [
                    'sort_order' => $index + 1,
                    'status' => true,
                ])
            );
        }
    }
}
