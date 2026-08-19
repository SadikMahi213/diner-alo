<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Volunteer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class VolunteerController extends Controller
{
    /**
     * Display the volunteer registration form.
     */
    public function create()
    {
        return view('front.volunteer.create');
    }

    /**
     * Store a new volunteer application.
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
            'skills' => 'nullable|string|max:500',
            'availability' => 'required|in:weekends,weekdays,flexible,full_time',
            'preferred_activity' => 'required|in:education,medical,food,relief,events,administrative,other',
            'experience' => 'nullable|string|max:500',
        ]);

        // Create volunteer application
        $volunteer = Volunteer::create([
            'user_id' => $request->user()?->id,
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'email' => $validated['email'],
            'district' => $validated['district'],
            'profession' => $validated['profession'],
            'skills' => $validated['skills'],
            'availability' => $validated['availability'],
            'preferred_activity' => $validated['preferred_activity'],
            'experience' => $validated['experience'],
            'status' => 'pending',
        ]);

        // TODO: Send notification to admin for review
        // In a real implementation, would send email or notification

        return redirect()->route('volunteer.thankyou')
            ->with('success', 'Volunteer application submitted successfully! Our team will review your application and contact you soon.');
    }

    /**
     * Display thank you page after volunteer submission.
     */
    public function thankyou()
    {
        return view('front.volunteer.thankyou');
    }
}