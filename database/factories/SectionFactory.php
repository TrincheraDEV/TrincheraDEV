<?php

namespace Database\Factories;

use App\Models\Section;
use Illuminate\Database\Eloquent\Factories\Factory;

class SectionFactory extends Factory
{
    protected $model = Section::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->words(3, true),
            'description' => $this->faker->paragraph,
            'order' => $this->faker->numberBetween(1, 10),
        ];
    }
}