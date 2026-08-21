<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;

class MembershipController extends Controller
{
    public function index(Request $request)
    {
        $query = Member::with('user')->latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('member_id', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($request->filled('membership_type')) {
            $query->where('membership_type', $request->membership_type);
        }

        if ($request->filled('status')) {
            $status = $request->status;
            if ($status === 'active') $query->where('is_active', true);
            elseif ($status === 'inactive') $query->where('is_active', false);
            else $query->where('status', $status);
        }

        $members = $query->paginate(20)->withQueryString();
        return view('admin.members.index', compact('members'));
    }

    public function show(Member $member)
    {
        $member->load('user');
        return view('admin.members.show', compact('member'));
    }
}
