<?php

use App\Models\Course;
use App\Models\Lesson;
use App\Models\Section;

it('can view courses', function () {
    $response = $this->get('/courses');

    $response->assertStatus(200);
});

it('can view course', function () {
    $course = Course::first();

    $response = $this->get(route('courses.show', ['slug' => $course->slug]));

    $response->assertStatus(200);
});

it('has enroll button if user is not enrolled', function () {
    $course = Course::first();

    $response = $this->get(route('courses.show', ['slug' => $course->slug]));

    $response->assertSee('Enroll to course');
});

it('has course section and lessons', function () {
    $course = Course::first();

    $response = $this->get(route('courses.show', ['slug' => $course->slug]));

    $sections = Section::where('course_id', $course->id)->get();

    foreach ($sections as $section) {
        $response->assertSee($section->title);
        $response->assertSee($section->description);
    }

    $lessons = Lesson::where('section_id', $sections->first()->id)->get();

    foreach ($lessons as $lesson) {
        $response->assertSee($lesson->title);
    }
});

