<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\GalleryAlbum;
use App\Models\GalleryItem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GalleryController extends Controller
{
    /**
     * Display the gallery index.
     */
    public function index()
    {
        $albums = GalleryAlbum::with('items')->whereHas('items', function ($query) {
            $query->where('is_published', true);
        })->latest()->get();

        return view('front.gallery.index', compact('albums'));
    }

    /**
     * Display a single gallery album.
     */
    public function show($slug)
    {
        $album = GalleryAlbum::with('items')->where('slug', $slug)->whereHas('items', function ($query) {
            $query->where('is_published', true);
        })->firstOrFail();

        return view('front.gallery.show', compact('album'));
    }
}