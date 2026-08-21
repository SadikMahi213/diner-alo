<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Project;

class ActivitiesController extends Controller
{
    public function index()
    {
        $featuredProjects = Project::where('is_published', true)
            ->where('status', 'running')
            ->orderByDesc('collected_amount')
            ->take(9)
            ->get();

        $activeProjectsCount = Project::where('is_published', true)->where('status', 'running')->count();

        // If no published projects, fallback to running (for backward compat during transition)
        if ($featuredProjects->isEmpty()) {
            $featuredProjects = Project::where('status', 'running')->orderByDesc('collected_amount')->take(9)->get();
            $activeProjectsCount = Project::where('status', 'running')->count();
        }

        return view('front.activities.index', compact('featuredProjects', 'activeProjectsCount'));
    }
}