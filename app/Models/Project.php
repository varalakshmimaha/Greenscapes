<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'description', 'before_image', 'after_image', 'image', 'status', 'client_name', 'is_active', 'order'];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
