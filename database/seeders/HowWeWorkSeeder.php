<?php

namespace Database\Seeders;

use App\Models\HowWeWork;
use Illuminate\Database\Seeder;

class HowWeWorkSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'title' => '1. Market & Policy Analysis',
                'description' => 'We analyse market dynamics, regulatory environments and emerging trends to inform strategic decisions.',
            ],
            [
                'title' => '2. Strategy & Advisory',
                'description' => 'We provide tailored strategies to governments, investors and enterprises across digital and infrastructure sectors.',
            ],
            [
                'title' => '3. Implementation Support',
                'description' => 'We support clients in executing strategies, partnerships and large-scale programmes.',
            ],
            [
                'title' => '4. Impact & Thought Leadership',
                'description' => 'We deliver insights, research and thought leadership to shape digital economies and policy frameworks.',
            ],
        ];

        foreach ($items as $index => $item) {
            HowWeWork::updateOrCreate(
                ['title' => $item['title']],
                array_merge($item, [
                    'sort_order' => $index + 1,
                    'status' => true,
                ])
            );
        }
    }
}
