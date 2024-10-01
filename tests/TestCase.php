<?php

namespace Tests;

use App\Models\User;
use Database\Seeders\CourseSeeder;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Hash;
use Laravel\Jetstream\Jetstream;

abstract class TestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        
        $this->actingAs($this->user);
    }
}
