<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceCategory extends Model
{
    protected $fillable = ['name', 'slug', 'image', 'is_active', 'order'];

    protected $casts = ['is_active' => 'boolean'];

    public function subCategories()
    {
        return $this->hasMany(ServiceSubCategory::class)->orderBy('order');
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }
}
