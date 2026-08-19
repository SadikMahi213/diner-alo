<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'user_id',
        'order_id',
        'donation_id',
        'transaction_id',
        'amount',
        'type',
        'status',
        'description',
        'gateway',
        'gateway_name',
        'gateway_transaction_id',
        'gateway_session_id',
        'gateway_response',
        'failure_reason',
        'currency',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function donation()
    {
        return $this->belongsTo(Donation::class);
    }
}
