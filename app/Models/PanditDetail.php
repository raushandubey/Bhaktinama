<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PanditDetail extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'specialization',
        'rating',
        'experience_years',
        'phone',
        'expertise_areas',
        'languages_known',
        'is_verified',
        'is_available',
        'completed_pujas',
        'total_reviews'
    ];

    protected $casts = [
        'expertise_areas' => 'array',
        'languages_known' => 'array',
        'is_verified' => 'boolean',
        'is_available' => 'boolean',
        'rating' => 'float'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
} 