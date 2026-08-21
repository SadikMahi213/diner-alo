<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donor;
use Illuminate\Http\Request;

class DonorController extends Controller
{
    public function index(Request $request)
    {
        $query = Donor::withCount('donations')
            ->withSum(['donations as successful_sum' => fn($q) => $q->where('status','successful')], 'amount')
            ->latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('mobile_number', 'like', "%{$search}%");
            });
        }

        $donors = $query->paginate(20)->withQueryString();
        return view('admin.donors.index', compact('donors'));
    }

    public function show(Donor $donor)
    {
        $donor->load(['donations' => fn($q) => $q->latest()->with(['fund','project','transaction']), 'user']);
        $totalSuccessful = $donor->donations->where('status','successful')->sum('amount');
        return view('admin.donors.show', compact('donor','totalSuccessful'));
    }
}
