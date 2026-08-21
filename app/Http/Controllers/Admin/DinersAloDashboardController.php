<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Donation;
use App\Models\Project;
use App\Models\Donor;
use App\Models\Member;
use App\Models\Volunteer;
use App\Models\BlogPost;
use App\Models\GalleryAlbum;
use App\Models\GalleryItem;
use App\Models\ContactMessage;
use App\Models\Report;
use App\Models\Setting;
use Illuminate\Support\Facades\DB;

class DinersAloDashboardController extends Controller
{


    /**
     * Show the admin dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Dashboard statistics
        $totalDonations = Donation::count();
        $todayDonations = Donation::whereDate('created_at', today())->count();
        $monthlyDonations = Donation::whereMonth('created_at', now()->month)->count();
        $successfulTransactions = Donation::where('status', 'successful')->count();
        $pendingTransactions = Donation::where('status', 'pending')->count();
        $failedTransactions = Donation::where('status', 'failed')->count();
        
        // Financial totals
        $totalDonationAmount = Donation::where('status', 'successful')->sum('amount');
        $todayDonationAmount = Donation::whereDate('created_at', today())->where('status', 'successful')->sum('amount');
        $monthlyDonationAmount = Donation::whereMonth('created_at', now()->month)->where('status', 'successful')->sum('amount');
        
        // Projects
        $activeProjects = Project::where('status', 'running')->count();
        $completedProjects = Project::where('status', 'completed')->count();
        
        // Volunteers and Members
        $totalVolunteers = Volunteer::count();
        $approvedVolunteers = Volunteer::where('status', 'approved')->count();
        $totalMembers = Member::count();
        
        // Blog posts
        $totalBlogPosts = BlogPost::count();
        $publishedBlogPosts = BlogPost::where('is_published', true)->count();
        
        // Gallery
        $totalGalleryItems = GalleryItem::count();
        $publishedGalleryItems = GalleryItem::whereHas('album', fn($q) => $q->where('is_published', true))->count();
        
        // Contact messages
        $newContactMessages = ContactMessage::where('status', 'new')->count();
        $totalContactMessages = ContactMessage::count();
        
        // Settings
        $settings = Setting::all();
        
        return view('admin.dashboard', compact(
            'totalDonations', 'todayDonations', 'monthlyDonations',
            'successfulTransactions', 'pendingTransactions', 'failedTransactions',
            'totalDonationAmount', 'todayDonationAmount', 'monthlyDonationAmount',
            'activeProjects', 'completedProjects', 'totalVolunteers', 'approvedVolunteers',
            'totalMembers', 'totalBlogPosts', 'publishedBlogPosts', 'totalGalleryItems',
            'publishedGalleryItems', 'newContactMessages', 'totalContactMessages', 'settings'
        ));
    }
    
    /**
     * Get donations table data for AJAX.
     */
    public function donationsDatatable(Request $request)
    {
        $query = Donation::with(['donor', 'fund', 'project']);
        
        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        // Filter by date range
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }
        
        // Filter by amount
        if ($request->filled('min_amount')) {
            $query->where('amount', '>=', $request->min_amount);
        }
        if ($request->filled('max_amount')) {
            $query->where('amount', '<=', $request->max_amount);
        }
        
        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('transaction_id', 'like', "%{$search}%")
                  ->orWhereHas('donor', function ($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%");
                  });
            });
        }
        
        $donations = $query->latest()->paginate($request->per_page ?? 20);
        
        return response()->json($donations);
    }
    
    /**
     * Get projects table data for AJAX.
     */
    public function projectsDatatable(Request $request)
    {
        $query = Project::with(['category']);
        
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('title', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%");
        }
        
        $projects = $query->latest()->paginate($request->per_page ?? 10);
        
        return response()->json($projects);
    }
    
    /**
     * Get donors table data for AJAX.
     */
    public function donorsDatatable(Request $request)
    {
        $query = Donor::with('donations');
        
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('mobile_number', 'like', "%{$search}%");
        }
        
        $donors = $query->latest()->paginate($request->per_page ?? 15);
        
        return response()->json($donors);
    }
    
    /**
     * Get volunteers table data for AJAX.
     */
    public function volunteersDatatable(Request $request)
    {
        $query = Volunteer::with('user');
        
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('district', 'like', "%{$search}%");
        }
        
        $volunteers = $query->latest()->paginate($request->per_page ?? 15);
        
        return response()->json($volunteers);
    }
    
    /**
     * Get members table data for AJAX.
     */
    public function membersDatatable(Request $request)
    {
        $query = Member::with('user');
        
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('member_id', 'like', "%{$search}%");
        }
        
        $members = $query->latest()->paginate($request->per_page ?? 15);
        
        return response()->json($members);
    }
    
    /**
     * Get contact messages table data for AJAX.
     */
    public function contactMessagesDatatable(Request $request)
    {
        $query = ContactMessage::latest();
        
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
        }
        
        $messages = $query->paginate($request->per_page ?? 15);
        
        return response()->json($messages);
    }
    
    /**
     * Export donations report.
     */
    public function exportDonations(Request $request)
    {
        $query = Donation::with(['donor', 'fund', 'project']);
        
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('min_amount')) {
            $query->where('amount', '>=', $request->min_amount);
        }
        if ($request->filled('max_amount')) {
            $query->where('amount', '<=', $request->max_amount);
        }
        
        $donations = $query->get();
        
        // Generate CSV
        $callback = function($writer) use ($donations) {
            $writer->row(['Transaction ID', 'Donor Name', 'Email', 'Mobile', 'Amount', 'Payment Method', 'Status', 'Date', 'Project/Fund']);
            
            foreach ($donations as $donation) {
                $writer->row([
                    $donation->transaction_id,
                    $donation->donor->name,
                    $donation->donor->email,
                    $donation->donor->mobile_number,
                    number_format($donation->amount, 2),
                    $donation->payment_method,
                    $donation->status,
                    $donation->created_at->format('Y-m-d H:i:s'),
                    $donation->project?->title ?? $donation->fund?->name_en,
                ]);
            }
        };
        
        $filename = 'donations-' . now()->format('Y-m-d') . '.csv';
        
        return response()->streamDownload($callback, $filename, [
            'Content-Type' => 'text/csv',
        ]);
    }
    
    /**
     * Export members report.
     */
    public function exportMembers(Request $request)
    {
        $query = Member::with('user');
        
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('member_id', 'like', "%{$search}%");
        }
        
        $members = $query->get();
        
        $callback = function($writer) use ($members) {
            $writer->row(['Member ID', 'Name', 'Email', 'Phone', 'Membership Type', 'Join Date', 'Status']);
            
            foreach ($members as $member) {
                $writer->row([
                    $member->member_id,
                    $member->user->name,
                    $member->user->email,
                    $member->user->mobile_number,
                    $member->membership_type,
                    $member->join_date->format('Y-m-d'),
                    ucfirst($member->is_active ? 'Active' : 'Inactive'),
                ]);
            }
        };
        
        $filename = 'members-' . now()->format('Y-m-d') . '.csv';
        
        return response()->streamDownload($callback, $filename, [
            'Content-Type' => 'text/csv',
        ]);
    }
    
    /**
     * Get statistics charts data.
     */
    public function statisticsData(Request $request)
    {
        // Monthly donation trends
        $monthlyDonations = DB::table('donations')
            ->selectRaw('MONTH(created_at) as month, YEAR(created_at) as year, SUM(amount) as total, COUNT(*) as count')
            ->where('status', 'successful')
            ->whereYear('created_at', now()->year)
            ->groupBy('month', 'year')
            ->orderBy('month')
            ->get();
        
        // Status distribution
        $statusDistribution = Donation::where('status', '!=', null)
            ->select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->get();
        
        // Top funds/projects
        $topFunds = Donation::where('donation_fund_id', '!=', null)
            ->where('status', 'successful')
            ->select('donation_fund_id', DB::raw('SUM(amount) as total'))
            ->groupBy('donation_fund_id')
            ->orderByDesc('total')
            ->take(5)
            ->get();
        
        return response()->json([
            'monthly_trends' => $monthlyDonations->map(function($item) {
                return [
                    'month' => $item->month,
                    'total' => $item->total,
                    'count' => $item->count,
                ];
            }),
            'status_distribution' => $statusDistribution->mapWithKeys(function($item) {
                return [strtolower($item->status) => $item->count];
            }),
            'top_funds' => $topFunds->mapWithKeys(function($item) {
                return [$item->donation_fund_id ? $item->donation_fund_id : 'general' => number_format($item->total, 2)];
            }),
        ]);
    }
}