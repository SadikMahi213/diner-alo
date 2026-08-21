<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Models\Donor;
use App\Models\Project;
use App\Models\BlogPost;
use App\Models\DonationFund;
use App\Models\Volunteer;
use App\Models\Member;
use Illuminate\Support\Str;

class LandingController extends Controller
{
    public function index()
    {
        // Get statistics from the database
        $totalDonors = Donor::count();
        $totalDonations = Donation::where('status', 'successful')->sum('amount');
        $totalProjects = Project::where('status', 'running')->count();
        $totalVolunteers = Volunteer::where('status', 'approved')->count();
        $totalBeneficiaries = Project::where('status', 'completed')->sum('beneficiary_count');

        // Get active donation funds (match reference: is_active true)
        $donationFunds = DonationFund::where('is_active', true)->orderBy('id')->take(6)->get();

        // Get featured projects
        $featuredProjects = Project::where('status', 'running')
            ->orderByDesc('collected_amount')
            ->take(6)
            ->get();

        // Get latest blog posts (news)
        $latestNews = BlogPost::where('is_published', true)
            ->latest()
            ->take(3)
            ->get();

        return view('front.home', compact(
            'totalDonors',
            'totalDonations',
            'totalProjects',
            'totalVolunteers',
            'totalBeneficiaries',
            'donationFunds',
            'featuredProjects',
            'latestNews'
        ));
    }
}