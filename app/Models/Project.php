<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'title',
        'title_bn',
        'title_en',
        'slug',
        'description',
        'description_bn',
        'description_en',
        'short_description',
        'short_description_bn',
        'short_description_en',
        'cover_image',
        'gallery',
        'target_amount',
        'collected_amount',
        'beneficiary_count',
        'location',
        'start_date',
        'end_date',
        'status',
        'is_featured',
        'is_published',
        'is_program',
    ];

    protected $casts = [
        'target_amount' => 'decimal:2',
        'collected_amount' => 'decimal:2',
        'start_date' => 'date',
        'end_date' => 'date',
        'gallery' => 'array',
        'is_featured' => 'boolean',
        'is_published' => 'boolean',
        'is_program' => 'boolean',
    ];

    public function getTitleBnAttribute($value)
    {
        return $value ?? $this->attributes['title'] ?? null;
    }

    public function getTitleEnAttribute($value)
    {
        return $value ?? $this->attributes['title'] ?? null;
    }

    public function category()
    {
        return $this->belongsTo(ProjectCategory::class, 'category_id');
    }

    public function donations()
    {
        return $this->hasMany(Donation::class);
    }

    public function getProgressPercentageAttribute()
    {
        if ($this->target_amount > 0) {
            return min(100, ($this->collected_amount / $this->target_amount) * 100);
        }
        return 0;
    }
}