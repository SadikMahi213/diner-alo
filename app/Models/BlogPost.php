<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'title',
        'title_bn',
        'title_en',
        'slug',
        'excerpt',
        'excerpt_bn',
        'excerpt_en',
        'content',
        'content_bn',
        'content_en',
        'thumbnail',
        'author',
        'reading_time',
        'is_published',
        'is_featured',
        'published_at',
        'seo_title',
        'seo_description',
        'view_count',
    ];

    protected $casts = [
        'view_count' => 'integer',
        'is_published' => 'boolean',
        'is_featured' => 'boolean',
        'published_at' => 'datetime',
    ];

    public function category()
    {
        return $this->belongsTo(BlogCategory::class);
    }

    public function tags()
    {
        // Tags would be parsed from content or stored separately
        return [];
    }
}