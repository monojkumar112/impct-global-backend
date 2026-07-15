<?php

namespace Database\Seeders;

use App\Models\ContactPage;
use Illuminate\Database\Seeder;

class ContactPageSeeder extends Seeder
{
    public function run(): void
    {
        ContactPage::query()->updateOrCreate(
            ['id' => 1],
            [
                'page_badge' => 'Contact Us',
                'page_title' => "Let's connect and build the future together.",
                'card_badge' => 'Need help?',
                'card_title' => 'Speak with our experts',
                'card_description' => 'Email us directly or send a message through the form. We usually respond within one business day.',
                'email_label' => 'Email',
                'email' => 'impactafriqueglobal@gmail.com',
                'office_label' => 'Office',
                'office_address' => '20 Wenlock Road, London. N1, 7GU. United Kingdom',
            ]
        );
    }
}
