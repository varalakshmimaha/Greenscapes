<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'role', 'photo', 'bio', 'facebook', 'linkedin', 'instagram', 'is_active', 'order', 'team_category_id'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(TeamCategory::class, 'team_category_id');
    }
}
