<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Project;

class ActivitiesController extends Controller
{
    public function index()
    {
        $featuredProjects = Project::where('status', 'running')
            ->orderByDesc('collected_amount')
            ->take(9)
            ->get();

        $activeProjectsCount = Project::where('status', 'running')->count();

        return view('front.activities.index', compact('featuredProjects', 'activeProjectsCount'));
    }
}