<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'description', 'featured_image', 'gallery_images', 'status', 'client_name', 'category', 'location', 'area', 'completion_date', 'project_manager', 'is_active', 'order'];

    protected $casts = [
        'is_active' => 'boolean',
        'gallery_images' => 'array',
    ];
}
