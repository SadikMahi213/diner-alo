<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DonationFund;
use App\Models\ProjectCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DonationFundController extends Controller
{
    public function index(Request $request)
    {
        $query = DonationFund::with('category')->withCount('donations');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name_bn', 'like', "%{$search}%")
                  ->orWhere('name_en', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($request->filled('is_active')) {
            $query->where('is_active', $request->is_active === '1');
        }

        $funds = $query->latest()->paginate(15)->withQueryString();
        return view('admin.donation-funds.index', compact('funds'));
    }

    public function create()
    {
        $categories = ProjectCategory::all();
        return view('admin.donation-funds.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name_bn' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:donation_funds,slug',
            'description' => 'nullable|string',
            'category_id' => 'nullable|exists:project_categories,id',
            'minimum_amount' => 'required|numeric|min:0',
            'is_active' => 'boolean',
        ]);

        $validated['slug'] = $validated['slug'] ?? Str::slug($validated['name_en']);
        $validated['is_active'] = $validated['is_active'] ?? true;

        DonationFund::create($validated);

        return redirect()->route('admin.donation-funds.index')->with('success', 'Donation fund created successfully.');
    }

    public function edit(DonationFund $donationFund)
    {
        $categories = ProjectCategory::all();
        return view('admin.donation-funds.edit', compact('donationFund', 'categories'));
    }

    public function update(Request $request, DonationFund $donationFund)
    {
        $validated = $request->validate([
            'name_bn' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:donation_funds,slug,' . $donationFund->id,
            'description' => 'nullable|string',
            'category_id' => 'nullable|exists:project_categories,id',
            'minimum_amount' => 'required|numeric|min:0',
            'is_active' => 'boolean',
        ]);

        $validated['slug'] = $validated['slug'] ?? Str::slug($validated['name_en']);
        $validated['is_active'] = $request->has('is_active');

        $donationFund->update($validated);

        return redirect()->route('admin.donation-funds.index')->with('success', 'Donation fund updated successfully.');
    }

    public function destroy(DonationFund $donationFund)
    {
        if ($donationFund->donations()->exists()) {
            return back()->with('error', 'Cannot delete fund with existing donations. Deactivate instead.');
        }

        $donationFund->delete();
        return redirect()->route('admin.donation-funds.index')->with('success', 'Donation fund deleted successfully.');
    }

    public function toggle(DonationFund $donationFund)
    {
        $donationFund->update(['is_active' => !$donationFund->is_active]);
        return back()->with('success', 'Fund status updated.');
    }
}
