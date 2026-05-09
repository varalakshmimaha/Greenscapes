<?php

namespace App\Models;

use App\Helpers\BlogContentFormatter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'excerpt', 'content', 'image', 'category', 'author', 'is_published', 'published_at'];

    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];

    public function getFormattedContentAttribute(): string
    {
        return BlogContentFormatter::format($this->content);
    }

    public function getSeoDescriptionAttribute(): string
    {
        $description = $this->excerpt ?: BlogContentFormatter::toPlainText($this->content);

        return Str::limit(trim($description), 160, '...');
    }
}
