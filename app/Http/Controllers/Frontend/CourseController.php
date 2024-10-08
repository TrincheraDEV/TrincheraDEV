<?php

namespace App\Http\Controllers\Frontend;

use App\Enums\Status;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::query()->where('status', Status::PUBLISHED)->orderBy('title', 'asc')->get();
        return view('frontend.courses.index', compact('courses'));
    }
    public function show(string $slug)
    {
        $course = Course::query()->where('slug', $slug)->firstOrFail();
        $sections = $course->sections()->get();
        return view('frontend.courses.show', compact('course', 'sections'));
    }

    public function showLesson(string $courseSlug, string $lessonSlug)
    {
        $course = Course::query()->where('slug', $courseSlug)->firstOrFail();
        $lesson = Lesson::query()->whereHas('sections', function ($query) use ($course, $lessonSlug) {
            $query->where('course_id', $course->getKey())->where('lessons.slug', $lessonSlug);
        })->firstOrFail();

        return view('frontend.courses.show-lesson', compact('course', 'lesson'));
    }
}