<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'description', 'image', 'pdf', 'icon', 'category', 'service_category_id', 'service_sub_category_id', 'is_active', 'order'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function serviceCategory()
    {
        return $this->belongsTo(ServiceCategory::class);
    }

    public function serviceSubCategory()
    {
        return $this->belongsTo(ServiceSubCategory::class);
    }
}
