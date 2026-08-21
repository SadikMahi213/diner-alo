<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query()->latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        $users = $query->paginate(20)->withQueryString();
        return view('admin.users.index', compact('users'));
    }

    public function show(User $user)
    {
        $user->load(['orders.package', 'transactions', 'wallet', 'courses']);
        return view('admin.users.show', compact('user'));
    }

    public function toggle(User $user)
    {
        // Simple toggle for demo: we don't have is_active, so we just log
        // In real app, you would have is_blocked or similar
        return back()->with('success', 'User status toggled (demo).');
    }
}
