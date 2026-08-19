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
        'slug',
        'excerpt',
        'content',
        'thumbnail',
        'author',
        'reading_time',
        'is_published',
        'view_count',
    ];

    protected $casts = [
        'view_count' => 'integer',
        'is_published' => 'boolean',
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