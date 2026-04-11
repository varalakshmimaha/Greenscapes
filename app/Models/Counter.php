<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Counter extends Model
{
    use HasFactory;

    protected $fillable = ['icon', 'number', 'suffix', 'label', 'is_active', 'order'];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
