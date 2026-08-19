<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    /**
     * Display a listing of the blog posts.
     */
    public function index()
    {
        $categories = BlogCategory::where('is_published', true)->get();
        $posts = BlogPost::where('is_published', true)
            ->latest()
            ->paginate(10);

        return view('front.blog.index', compact('posts', 'categories'));
    }

    /**
     * Display a single blog post.
     */
    public function show($slug)
    {
        $post = BlogPost::where('slug', $slug)->where('is_published', true)->firstOrFail();
        
        // Increment view count
        $post->increment('view_count');
        
        // Get related posts (same category)
        $relatedPosts = BlogPost::where('category_id', $post->category_id)
            ->where('id', '!=', $post->id)
            ->where('is_published', true)
            ->latest()
            ->take(3)
            ->get();

        return view('front.blog.show', compact('post', 'relatedPosts'));
    }

    /**
     * Display blog by category.
     */
    public function category($slug)
    {
        $category = BlogCategory::where('slug', $slug)->where('is_published', true)->firstOrFail();
        $posts = BlogPost::where('category_id', $category->id)
            ->where('is_published', true)
            ->latest()
            ->paginate(10);

        return view('front.blog.category', compact('posts', 'category'));
    }
}