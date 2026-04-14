<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceCategory extends Model
{
    protected $fillable = ['service_id', 'name', 'slug', 'image', 'pdf', 'description', 'is_active', 'order'];

    protected $casts = ['is_active' => 'boolean'];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function subCategories()
    {
        return $this->hasMany(ServiceSubCategory::class)->orderBy('order');
    }
}
