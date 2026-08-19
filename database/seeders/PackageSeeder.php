<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Package;
use App\Models\Course;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all courses
        $courses = Course::all();

        // Create sample packages
        $package1 = Package::create([
            'title' => 'Web Development Starter Pack',
            'description' => 'Perfect for beginners who want to learn web development',
            'price' => 99.99,
            'is_active' => true
        ]);

        // Attach courses to the package
        $package1->courses()->attach([$courses[0]->id, $courses[2]->id]);

        $package2 = Package::create([
            'title' => 'Full Stack Developer Bundle',
            'description' => 'Complete bundle for aspiring full stack developers',
            'price' => 299.99,
            'is_active' => true
        ]);

        // Attach all courses to the package
        $package2->courses()->attach($courses->pluck('id')->toArray());

        $package3 = Package::create([
            'title' => 'Backend Specialization',
            'description' => 'Focus on backend technologies including PHP, Laravel, and databases',
            'price' => 199.99,
            'is_active' => true
        ]);

        // Attach backend courses to the package
        $package3->courses()->attach([$courses[0]->id, $courses[1]->id, $courses[3]->id]);
    }
}
