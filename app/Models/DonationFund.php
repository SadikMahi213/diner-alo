<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonationFund extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'icon',
        'is_active',
        'target_amount',
        'current_amount',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'target_amount' => 'decimal:2',
        'current_amount' => 'decimal:2',
    ];

    public function donations()
    {
        return $this->hasMany(Donation::class);
    }

    public function getProgressPercentageAttribute()
    {
        if ($this->target_amount > 0) {
            return min(100, ($this->current_amount / $this->target_amount) * 100);
        }
        return 0;
    }
}