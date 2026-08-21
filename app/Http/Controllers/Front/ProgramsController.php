<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

class ProgramsController extends Controller
{
    public function index()
    {
        // Try to load from DB first (published programs)
        $dbPrograms = \App\Models\Project::with('category')
            ->where('is_published', true)
            ->where('is_program', true)
            ->whereIn('status', ['running', 'upcoming', 'completed'])
            ->orderBy('is_featured', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

        if ($dbPrograms->isNotEmpty()) {
            $programs = $dbPrograms->map(function ($project) {
                $iconMap = [
                    'education' => ['bg' => 'bg-emerald-50 text-emerald-600', 'icon' => '<svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"/></svg>'],
                    'health' => ['bg' => 'bg-rose-50 text-rose-600', 'icon' => '<svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>'],
                    'default' => ['bg' => 'bg-emerald-50 text-emerald-600', 'icon' => '<svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>'],
                ];
                $cat = strtolower($project->category?->name_en ?? '');
                $style = $iconMap[$cat] ?? $iconMap['default'];
                $locale = app()->getLocale();
                $title = $locale === 'bn' ? ($project->title_bn ?? $project->title) : ($project->title_en ?? $project->title);
                $desc = $locale === 'bn' ? ($project->description_bn ?? $project->description) : ($project->description_en ?? $project->description);
                return [
                    'title' => $title,
                    'description' => \Illuminate\Support\Str::limit(strip_tags($desc), 180),
                    'icon' => $style['icon'],
                    'icon_bg' => $style['bg'],
                    'link' => route('about'),
                ];
            })->toArray();
        } else {
            // Fallback to hardcoded six (for empty DB, ensures frontend not empty)
            $programs = [
                [
                    'title' => 'শিক্ষা ও দক্ষতা উন্নয়ন',
                    'description' => 'নিরক্ষরতা দূরীকরণ, সুবিধাবঞ্চিত শিশুদের শিক্ষা নিশ্চিতকরণ ও কারিগরি এবং বৃত্তিমূলক প্রশিক্ষণের মাধ্যমে দক্ষ জনশক্তি গড়ে তোলা আমাদের অন্যতম প্রধান প্রকল্প।',
                    'icon' => '<svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"/></svg>',
                    'icon_bg' => 'bg-emerald-50 text-emerald-600',
                    'link' => route('about'),
                ],
                [
                    'title' => 'স্বাবলম্বীকরণ প্রকল্প',
                    'description' => 'দরিদ্র ও অসহায় মানুষের জন্য আয়-বর্ধনমূলক প্রশিক্ষণ, ক্ষুদ্র উদ্যোক্তা উন্নয়ন ও কর্মসংস্থান সৃষ্টির মাধ্যমে তাদের স্বয়ংসম্পূর্ণ করে তোলা।',
                    'icon' => '<svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>',
                    'icon_bg' => 'bg-blue-50 text-blue-600',
                    'link' => route('about'),
                ],
                [
                    'title' => 'স্বাস্থ্য ও চিকিৎসা সেবা',
                    'description' => 'সুচিকিৎসা, কমিউনিটি স্বাস্থ্যসেবা, মেডিকেল ক্যাম্প ও মাতৃ ও শিশু স্বাস্থ্যের উন্নয়নে নিরলসভাবে কাজ করে যাচ্ছে আমাদের স্বেচ্ছাসেবকরা।',
                    'icon' => '<svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>',
                    'icon_bg' => 'bg-rose-50 text-rose-600',
                    'link' => route('about'),
                ],
                [
                    'title' => 'বিশুদ্ধ পানি প্রকল্প',
                    'description' => 'গ্রামীণ জনপদে নিরাপদ পানি সরবরাহ, টিউবওয়েল স্থাপন ও পানি সংরক্ষণের মাধ্যমে পানিজনিত রোগ প্রতিরোধে কাজ করা।',
                    'icon' => '<svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M6 21h12m-9-6a3 3 0 01-3-3V6a3 3 0 016 0v6a3 3 0 01-3 3zm3-9v3"/></svg>',
                    'icon_bg' => 'bg-cyan-50 text-cyan-600',
                    'link' => route('about'),
                ],
                [
                    'title' => 'পরিবেশ ও বৃক্ষরোপণ',
                    'description' => 'পরিবেশ রক্ষায় ব্যাপক বৃক্ষরোপণ কর্মসূচি, সচেতনতা তৈরি ও জলবায়ু পরিবর্তনের বিরূপ প্রভাব মোকাবিলায় টেকসই উদ্যোগ।',
                    'icon' => '<svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21c6-2 12-2 18 0M5 21v-7a7 7 0 0114 0v7M12 7V3m-3 3h6M12 7c0-4-3-3-3-3s0 2 3 3zm0 0c0-4 3-3 3-3s0 2-3 3z"/></svg>',
                    'icon_bg' => 'bg-lime-50 text-lime-600',
                    'link' => route('about'),
                ],
                [
                    'title' => 'দুর্যোগ ব্যবস্থাপনা',
                    'description' => 'প্রাকৃতিক দুর্যোগে ত্রাণ বিতরণ, পুনর্বাসন ও দুর্যোগ-পরবর্তী পুনর্গঠন কর্মসূচির মাধ্যমে ক্ষতিগ্রস্ত মানুষের পাশে দাঁড়ানো।',
                    'icon' => '<svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21l-7-5-7 5V5a2 2 0 012-2h10a2 2 0 012 2v16z"/></svg>',
                    'icon_bg' => 'bg-amber-50 text-amber-600',
                    'link' => route('about'),
                ],
            ];
        }

        return view('front.programs.index', compact('programs'));
    }
}