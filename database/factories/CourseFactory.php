<?php

namespace Database\Factories;

use App\Enums\Status;
use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    protected $model = Course::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'slug' => $this->faker->slug,
            'description' => $this->faker->paragraph,
            'image' => $this->faker->imageUrl(),
            'video_id' => '997727821',
            'status' => $this->faker->randomElement(Status::cases())->value,
        ];
    }
}