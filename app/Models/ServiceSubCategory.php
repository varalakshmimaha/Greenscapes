<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceSubCategory extends Model
{
    protected $fillable = ['service_category_id', 'name', 'slug', 'description', 'image', 'pdf', 'is_active', 'order'];

    protected $casts = ['is_active' => 'boolean'];

    public function category()
    {
        return $this->belongsTo(ServiceCategory::class, 'service_category_id');
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }
}
