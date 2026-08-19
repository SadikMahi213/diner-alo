<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donor extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'mobile_number',
        'blood_group',
        'address',
    ];

    public function donations()
    {
        return $this->hasMany(Donation::class);
    }
}