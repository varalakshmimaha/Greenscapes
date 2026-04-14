<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceCategory extends Model
{
    protected $fillable = ['service_id', 'name', 'slug', 'image', 'description', 'is_active', 'order'];

    protected $casts = ['is_active' => 'boolean'];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
