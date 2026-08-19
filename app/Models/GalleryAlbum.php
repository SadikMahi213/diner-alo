<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryAlbum extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'category',
        'event_year',
        'is_published',
    ];

    protected $casts = [
        'is_published' => 'boolean',
    ];

    public function items()
    {
        return $this->hasMany(GalleryItem::class, 'album_id');
    }
}