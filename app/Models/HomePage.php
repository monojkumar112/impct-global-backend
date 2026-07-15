<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomePage extends Model
{
    use HasFactory;

    protected $fillable = [
        'hero_badge',
        'hero_title',
        'hero_description',
        'hero_tagline',
        'hero_primary_btn_text',
        'hero_primary_btn_link',
        'hero_secondary_btn_text',
        'hero_secondary_btn_link',
        'hero_map_label',
        'hero_priorities',
        'hero_image',
        'who_title',
        'who_description',
        'who_btn_text',
        'who_btn_link',
        'who_image',
        'story_label',
        'story_title',
        'story_description',
        'story_features',
        'story_btn_text',
        'story_btn_link',
        'story_image',
        'story_quote',
        'story_quote_author',
        'why_title',
        'why_description',
        'why_items',
        'join_badge',
        'join_title',
        'join_description',
        'join_primary_btn_text',
        'join_primary_btn_link',
        'join_secondary_btn_text',
        'join_secondary_btn_link',
    ];

    protected $casts = [
        'hero_priorities' => 'array',
        'story_features' => 'array',
        'why_items' => 'array',
    ];

    public function imageUrl(?string $path): ?string
    {
        return $path ? asset($path) : null;
    }

    public function toApiArray(): array
    {
        return [
            'hero' => [
                'badge' => $this->hero_badge,
                'title' => $this->hero_title,
                'description' => $this->hero_description,
                'tagline' => $this->hero_tagline,
                'primaryBtnText' => $this->hero_primary_btn_text,
                'primaryBtnLink' => $this->hero_primary_btn_link,
                'secondaryBtnText' => $this->hero_secondary_btn_text,
                'secondaryBtnLink' => $this->hero_secondary_btn_link,
                'mapLabel' => $this->hero_map_label,
                'priorities' => $this->hero_priorities ?? [],
                'image' => $this->imageUrl($this->hero_image),
            ],
            'who' => [
                'title' => $this->who_title,
                'description' => $this->who_description,
                'btnText' => $this->who_btn_text,
                'btnLink' => $this->who_btn_link,
                'image' => $this->imageUrl($this->who_image),
            ],
            'story' => [
                'label' => $this->story_label,
                'title' => $this->story_title,
                'description' => $this->story_description,
                'features' => $this->story_features ?? [],
                'btnText' => $this->story_btn_text,
                'btnLink' => $this->story_btn_link,
                'image' => $this->imageUrl($this->story_image),
                'quote' => $this->story_quote,
                'quoteAuthor' => $this->story_quote_author,
            ],
            'whyChoose' => [
                'title' => $this->why_title,
                'description' => $this->why_description,
                'items' => $this->why_items ?? [],
            ],
            'joinUs' => [
                'badge' => $this->join_badge,
                'title' => $this->join_title,
                'description' => $this->join_description,
                'primaryBtnText' => $this->join_primary_btn_text,
                'primaryBtnLink' => $this->join_primary_btn_link,
                'secondaryBtnText' => $this->join_secondary_btn_text,
                'secondaryBtnLink' => $this->join_secondary_btn_link,
            ],
        ];
    }
}
