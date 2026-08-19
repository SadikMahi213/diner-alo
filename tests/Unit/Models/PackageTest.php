<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Package;
use App\Models\Course;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PackageTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_package_can_have_courses()
    {
        // Create a package
        $package = Package::factory()->create();

        // Create courses
        $course1 = Course::factory()->create();
        $course2 = Course::factory()->create();

        // Attach courses to package
        $package->courses()->attach([$course1->id, $course2->id]);

        // Assert that the package has the courses
        $this->assertCount(2, $package->courses);
        $this->assertTrue($package->courses->contains($course1));
        $this->assertTrue($package->courses->contains($course2));
    }

    /** @test */
    public function a_package_can_have_orders()
    {
        // Create a package
        $package = Package::factory()->create();

        // Create a user
        $user = User::factory()->create();

        // Create orders for the package
        $order1 = $package->orders()->create([
            'user_id' => $user->id,
            'amount' => 99.99,
            'status' => 'successful'
        ]);

        $order2 = $package->orders()->create([
            'user_id' => $user->id,
            'amount' => 199.99,
            'status' => 'pending'
        ]);

        // Assert that the package has the orders
        $this->assertCount(2, $package->orders);
        $this->assertEquals(99.99, $package->orders->first()->amount);
        $this->assertEquals('successful', $package->orders->first()->status);
    }
}
