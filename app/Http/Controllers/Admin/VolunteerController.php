<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Volunteer;
use Illuminate\Http\Request;

class VolunteerController extends Controller
{
    public function index(Request $request)
    {
        $query = Volunteer::latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('district', 'like', "%{$search}%")
                  ->orWhere('skills', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('preferred_activity')) {
            $query->where('preferred_activity', $request->preferred_activity);
        }

        if ($request->filled('availability')) {
            $query->where('availability', $request->availability);
        }

        $volunteers = $query->paginate(20)->withQueryString();
        return view('admin.volunteers.index', compact('volunteers'));
    }

    public function show(Volunteer $volunteer)
    {
        return view('admin.volunteers.show', compact('volunteer'));
    }

    public function approve(Volunteer $volunteer)
    {
        $volunteer->update(['status' => 'approved']);
        return back()->with('success', 'Volunteer approved.');
    }

    public function reject(Volunteer $volunteer)
    {
        $volunteer->update(['status' => 'rejected']);
        return back()->with('success', 'Volunteer rejected.');
    }

    public function deactivate(Volunteer $volunteer)
    {
        $volunteer->update(['status' => 'inactive']);
        return back()->with('success', 'Volunteer deactivated.');
    }
}
