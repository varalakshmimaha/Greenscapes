<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'subtitle', 'description', 'image', 'button_text', 'button_link', 'is_active', 'order'];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
