<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LessonCompletion extends Model
{
    use HasFactory;
    
    protected $fillable = ['user_id', 'lesson_id', 'completed_at'];

    protected $dates = ['completed_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    public function lessonCompleted($lessonId, $userId)
    {
        if (LessonCompletion::where('course_id', '=', $lessonId)->where('user_id', '=', $userId)->first()) {
            return true;
        }

        return false;
    }

    public static function enrolledToCourse($courseId, $userId)
    {
        if (Enrollment::where('course_id', '=', $courseId)->where('user_id', '=', $userId)->first()) {
            return true;
        }
        
        return false;
    }

    public static function getNextLesson($currentLessonId, $courseId)
    {
        $currentLesson = Lesson::findOrFail($currentLessonId);
        $currentSection = $currentLesson->sections()->where('course_id', $courseId)->first();

        if (!$currentSection) {
            return null;
        }

        // Get the current lesson's order
        $currentOrder = $currentSection->lessons()
            ->where('lessons.id', $currentLessonId)
            ->first()
            ->pivot
            ->order ?? 0;

        $nextLesson = $currentSection->lessons()
            ->where('lesson_section.order', '>', $currentOrder)
            ->orderBy('lesson_section.order')
            ->first();

        if (!$nextLesson) {
            $nextSection = Section::where('course_id', $courseId)
                ->where('order', '>', $currentSection->order)
                ->orderBy('order')
                ->first();

            if ($nextSection) {
                $nextLesson = $nextSection->lessons()->orderBy('lesson_section.order')->first();
            }
        }

        return $nextLesson;
    }
}
