<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'author',
        'excerpt',
        'content',
        'image',
        'custom_href',
        'status',
        'published_at',
    ];

    protected $casts = [
        'status' => 'boolean',
        'published_at' => 'datetime',
    ];

    public function getImageUrlAttribute(): ?string
    {
        return $this->image ? asset($this->image) : null;
    }

    public function getContentParagraphsAttribute(): array
    {
        if (empty($this->content)) {
            return [];
        }

        if (str_contains($this->content, '<')) {
            preg_match_all('/<p[^>]*>(.*?)<\/p>/is', $this->content, $matches);

            if (!empty($matches[1])) {
                return array_values(array_filter(array_map(function ($paragraph) {
                    return trim(strip_tags(html_entity_decode($paragraph, ENT_QUOTES | ENT_HTML5, 'UTF-8')));
                }, $matches[1])));
            }

            $text = trim(strip_tags(html_entity_decode($this->content, ENT_QUOTES | ENT_HTML5, 'UTF-8')));

            return $text !== '' ? [$text] : [];
        }

        return array_values(array_filter(array_map('trim', preg_split("/\R{2,}/", $this->content))));
    }

    public function toApiArray(): array
    {
        $date = $this->published_at ?? $this->updated_at;

        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'title' => $this->title,
            'author' => $this->author ?? 'Impact Afrique Global Partners',
            'date' => $date ? $date->format('F j, Y') : null,
            'image' => $this->image_url,
            'excerpt' => $this->excerpt,
            'summary' => $this->excerpt,
            'customHref' => $this->custom_href,
            'content' => $this->content_paragraphs,
            'content_html' => $this->content,
        ];
    }
}
