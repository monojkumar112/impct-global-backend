<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutPage extends Model
{
    use HasFactory;

    protected $fillable = [
        'hero_title',
        'hero_image',
        'hero_paragraphs',
    ];

    public function imageUrl(?string $path): ?string
    {
        return $path ? asset($path) : null;
    }

    public function toApiArray(): array
    {
        return [
            'hero' => [
                'title' => $this->hero_title,
                'image' => $this->imageUrl($this->hero_image),
                'paragraphs' => $this->hero_paragraphs,
            ],
        ];
    }
}
