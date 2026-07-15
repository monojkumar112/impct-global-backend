<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactPage extends Model
{
    use HasFactory;

    protected $fillable = [
        'page_badge',
        'page_title',
        'card_badge',
        'card_title',
        'card_description',
        'email_label',
        'email',
        'office_label',
        'office_address',
    ];

    public function toApiArray(): array
    {
        return [
            'pageBadge' => $this->page_badge,
            'pageTitle' => $this->page_title,
            'cardBadge' => $this->card_badge,
            'cardTitle' => $this->card_title,
            'cardDescription' => $this->card_description,
            'emailLabel' => $this->email_label,
            'email' => $this->email,
            'officeLabel' => $this->office_label,
            'officeAddress' => $this->office_address,
        ];
    }
}
