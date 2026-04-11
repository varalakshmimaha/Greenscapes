<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'image', 'section', 'is_active', 'order'];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
