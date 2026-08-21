<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonationFund extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name_bn',
        'name_en',
        'slug',
        'description',
        'icon',
        'minimum_amount',
        'suggested_amounts',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'minimum_amount' => 'decimal:2',
    ];

    // Accessor for backward compatibility: name returns name_bn
    public function getNameAttribute()
    {
        return $this->attributes['name_bn'] ?? $this->attributes['name_en'] ?? null;
    }

    public function donations()
    {
        return $this->hasMany(Donation::class);
    }

    public function getProgressPercentageAttribute()
    {
        // Calculate from donations sum vs minimum as target placeholder
        $total = $this->donations()->where('status', 'successful')->sum('amount');
        $target = (float) ($this->minimum_amount ?? 100000);
        if ($target > 0) {
            return min(100, ($total / $target) * 100);
        }
        return 0;
    }
}