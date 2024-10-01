<?php

namespace Database\Factories;

use App\Enums\Status;
use App\Models\Lesson;
use Illuminate\Database\Eloquent\Factories\Factory;

class LessonFactory extends Factory
{
    protected $model = Lesson::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'slug' => $this->faker->slug,
            'image' => $this->faker->imageUrl(),
            'video_id' => '997727821',
            'content' => "# " . $this->faker->sentence . "\n\n" . $this->faker->paragraphs(3, true),
            'status' => $this->faker->randomElement(Status::cases())->value,
        ];
    }
}