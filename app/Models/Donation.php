<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    protected $fillable = [
        'donor_id',
        'project_id',
        'donation_fund_id',
        'user_id',
        'amount',
        'payment_method',
        'transaction_id',
        'status',
        'message',
        'is_anonymous',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'is_anonymous' => 'boolean',
    ];

    public function donor()
    {
        return $this->belongsTo(Donor::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function fund()
    {
        return $this->belongsTo(DonationFund::class, 'donation_fund_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function transaction()
    {
        return $this->hasOne(Transaction::class);
    }

    /**
     * Check if the donation is in a successful state.
     */
    public function isSuccessful(): bool
    {
        return $this->status === 'successful';
    }

    /**
     * Check if the donation can be updated (i.e., not already successful).
     */
    public function canUpdateStatus(): bool
    {
        return $this->status !== 'successful';
    }
}