<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'description', 'image', 'pdf', 'icon', 'category', 'is_active', 'order'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function categories()
    {
        return $this->hasMany(ServiceCategory::class)->orderBy('order');
    }
}
