<?php

namespace Database\Seeders;

use App\Models\AboutPage;
use Illuminate\Database\Seeder;

class AboutPageSeeder extends Seeder
{
    public function run(): void
    {
        $paragraphs = [
            'A highly accomplished strategy, public policy, and international development leader with more than 19 years of experience shaping digital transformation, telecommunications policy, and sustainable development across highly regulated markets.',
            'Throughout an international career spanning government advisory, development finance, and the private sector, I have led cross-functional teams in designing evidence-based strategies and public policies that enable inclusive digital growth, strengthen regulatory frameworks, and deliver measurable social and economic impact.',
            'I have built trusted partnerships with global and regional institutions, including the United Nations (UN), OECD, UNESCO, ITU, World Bank, European Investment Bank (EIB), SADC, ECOWAS, COMTELCA, UNESCAP, and CARICOM. Working alongside governments, regulators, development agencies, and industry leaders, I have contributed to major ICT policy reforms that expand digital inclusion, accelerate broadband access, and support sustainable economic development.',
            'My expertise spans digital policy, regulatory strategy, infrastructure investment, connectivity, spectrum management, licensing frameworks, universal service, data governance, and digital inclusion. I have advised national governments on developing strategies that advance the UN Sustainable Development Goals (SDGs), particularly in affordable broadband access, digital infrastructure, gender equality, and inclusive economic participation.',
            'In addition to advising governments and organisations, I provide strategic guidance on investment policy, digital infrastructure development, and enabling environments that foster innovation, attract investment, and support resilient digital economies across emerging markets.',
            'Beyond my executive leadership, I serve on the boards of Delwik Group, an advisory and venture capital firm, and INASP, an international development organisation dedicated to strengthening research and knowledge ecosystems in developing countries. These roles reflect my long-standing commitment to empowering underrepresented communities, supporting evidence-driven policymaking, and creating lasting social impact through technology and innovation.',
        ];

        $content = collect($paragraphs)
            ->map(fn ($paragraph) => '<p>' . e($paragraph) . '</p>')
            ->implode('');

        AboutPage::query()->updateOrCreate(
            ['id' => 1],
            [
                'hero_title' => 'About The Founder',
                'hero_image' => null,
                'hero_paragraphs' => $content,
            ]
        );
    }
}
