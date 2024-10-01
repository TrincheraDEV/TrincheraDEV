<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Lesson;
use App\Models\Section;
use App\Models\User;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        Course::factory(10)->create()->each(function ($course) {
            Section::factory(3)->create(['course_id' => $course->id])->each(function ($section) {
                $lessons = Lesson::factory(5)->create();
                $order = 1;
                $lessonData = $lessons->mapWithKeys(function ($lesson) use (&$order) {
                    return [$lesson->id => ['order' => $order++]];
                })->toArray();
                $section->lessons()->attach($lessonData);
            });
        });

        // Create some enrollments
        $users = User::all();
        $courses = Course::all();

        foreach ($users as $user) {
            // Enroll each user in 1-3 random courses
            $coursesToEnroll = $courses->random(rand(1, 3));
            foreach ($coursesToEnroll as $course) {
                Enrollment::factory()->create([
                    'user_id' => $user->id,
                    'course_id' => $course->id,
                ]);
            }
        }
    }
}