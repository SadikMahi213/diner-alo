<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\Course;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::with('courses')->paginate(10);
        return view('admin.packages.index', compact('packages'));
    }

    public function create()
    {
        $courses = Course::all();
        return view('admin.packages.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'is_active' => 'boolean',
            'courses' => 'array|exists:courses,id',
        ]);

        $package = Package::create([
            'title' => $request['title'],
            'description' => $request['description'] ?? null,
            'price' => $request['price'],
            'is_active' => $request['is_active'] ?? false,
        ]);

        if (isset($request['courses'])) {
            $package->courses()->attach($request['courses']);
        }

        return redirect()->route('admin.packages.index')->with('success', 'Package created successfully.');
    }

    public function edit(Package $package)
    {
        $courses = Course::all();
        $packageCourses = $package->courses->pluck('id')->toArray();

        return view('admin.packages.edit', compact('package', 'courses', 'packageCourses'));
    }

    public function update(Request $request, Package $package)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'is_active' => 'boolean',
            'courses' => 'array|exists:courses,id',
        ]);

        $package->update([
            'title' => $request['title'],
            'description' => $request['description'] ?? null,
            'price' => $request['price'],
            'is_active' => $request['is_active'] ?? false,
        ]);

        if (isset($request['courses'])) {
            $package->courses()->sync($request['courses']);
        } else {
            $package->courses()->detach();
        }

        return redirect()->route('admin.packages.index')->with('success', 'Package updated successfully.');
    }

    public function destroy(Package $package)
    {
        $package->courses()->detach();
        $package->delete();

        return redirect()->route('admin.packages.index')->with('success', 'Package deleted successfully.');
    }
}