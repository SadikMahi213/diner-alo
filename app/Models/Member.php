<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'member_id',
        'name',
        'email',
        'phone',
        'district',
        'profession',
        'membership_type',
        'experience',
        'join_date',
        'expiry_date',
        'status',
        'is_active',
        'address',
        'nid',
    ];

    protected $casts = [
        'join_date' => 'date',
        'expiry_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}