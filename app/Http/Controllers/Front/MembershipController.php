<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MembershipController extends Controller
{
    /**
     * Display the membership application form.
     */
    public function create()
    {
        return view('front.membership.create')->with('member', null);
    }

    /**
     * Store a new membership application.
     */
    public function store(Request $request)
    {
        // Validate the form data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'district' => 'required|string|max:100',
            'profession' => 'required|string|max:100',
            'membership_type' => 'required|in:general,lifetime,contributor,volunteer',
            'experience' => 'nullable|string|max:500',
        ]);

        // Generate unique membership ID
        $memberId = 'M-' . str_pad(random_int(1, 99999), 5, '0', STR_PAD_LEFT);

        // Check for uniqueness
        while (Member::where('member_id', $memberId)->exists()) {
            $memberId = 'M-' . str_pad(random_int(1, 99999), 5, '0', STR_PAD_LEFT);
        }

        // Create membership application
        $member = Member::create([
            'user_id' => $request->user()?->id,
            'member_id' => $memberId,
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'email' => $validated['email'],
            'district' => $validated['district'],
            'profession' => $validated['profession'],
            'membership_type' => $validated['membership_type'],
            'experience' => $validated['experience'],
            'status' => 'pending',
        ]);

        // TODO: Send notification to admin for review
        // In a real implementation, would send email or notification

        return redirect()->route('membership.thankyou', ['id' => $member->id])
            ->with('success', 'Membership application submitted successfully! Your application is pending approval. You will be notified once it is processed.');
    }

    /**
     * Display thank you page after membership submission.
     */
    public function thankyou($id)
    {
        $member = Member::with('user')->findOrFail($id);
        return view('front.membership.thankyou', compact('member'));
    }
}