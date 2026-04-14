<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory;

    protected $fillable = ['category', 'question', 'answer', 'image', 'is_active', 'order'];

    const CATEGORIES = [
        'Home Page',
        'About Us',
        'Services & Projects',
        'Consultation & Project Process',
        'Landscape & Garden Design',
        'Garden Maintenance & Irrigation',
        'Nursery & Plant Orders',
        'Team & Contact',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
