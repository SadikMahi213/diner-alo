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
        'description',
        'cover_image',
        'gallery',
        'target_amount',
        'collected_amount',
        'beneficiary_count',
        'start_date',
        'end_date',
        'location',
        'status',
    ];

    protected $casts = [
        'target_amount' => 'decimal:2',
        'collected_amount' => 'decimal:2',
        'start_date' => 'date',
        'end_date' => 'date',
        'gallery' => 'array',
    ];

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