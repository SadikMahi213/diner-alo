<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryAlbum extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'title_bn',
        'title_en',
        'slug',
        'description',
        'description_bn',
        'description_en',
        'category',
        'event_year',
        'is_published',
        'is_featured',
        'sort_order',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'is_featured' => 'boolean',
    ];

    public function items()
    {
        return $this->hasMany(GalleryItem::class, 'album_id');
    }
}