<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\User;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create sample teachers
        $teacher1 = User::factory()->create([
            'name' => 'John Doe',
            'email' => 'john.doe@saifacademy.com',
            'password' => bcrypt('password'),
            'role' => 'teacher'
        ]);

        $teacher2 = User::factory()->create([
            'name' => 'Jane Smith',
            'email' => 'jane.smith@saifacademy.com',
            'password' => bcrypt('password'),
            'role' => 'teacher'
        ]);

        // Create sample courses
        Course::create([
            'name' => 'Introduction to Laravel',
            'short_description' => 'Learn the basics of Laravel framework',
            'teacher_id' => $teacher1->id,
            'status' => 'published',
            'enrolled_count' => 0
        ]);

        Course::create([
            'name' => 'Advanced PHP Techniques',
            'short_description' => 'Master advanced PHP concepts',
            'teacher_id' => $teacher2->id,
            'status' => 'published',
            'enrolled_count' => 0
        ]);

        Course::create([
            'name' => 'JavaScript Fundamentals',
            'short_description' => 'Learn the fundamentals of JavaScript',
            'teacher_id' => $teacher1->id,
            'status' => 'published',
            'enrolled_count' => 0
        ]);

        Course::create([
            'name' => 'Database Design Principles',
            'short_description' => 'Learn how to design efficient databases',
            'teacher_id' => $teacher2->id,
            'status' => 'published',
            'enrolled_count' => 0
        ]);
    }
}
