<?php

use App\Models\Lesson;
use App\Models\LessonCompletion;
use Livewire\Volt\Component;

new Class extends Component {
    public Lesson $lesson;
    
    public function complete()
    {
        sleep(1);
        
        LessonCompletion::create([
            'user_id' => auth()->user()->id,
            'lesson_id' => $this->lesson->id,
            'completed_at' => now(),
        ]);

        Flux::toast('Lesson completed!');

        $nextLesson = LessonCompletion::getNextLesson($this->lesson->id, $this->lesson->sections->first()->course_id);

        if ($nextLesson) {
            return redirect()->route('courses.show-lesson', [
                'courseSlug' => $nextLesson->sections->first()->course->slug,
                'lessonSlug' => $nextLesson->slug
            ]);
        } else {
            return redirect(request()->header('Referer'));
        }
    }
}

?>
<div>
    <form wire:submit="complete">
        <flux:button type="submit">
            Complete Lesson
        </flux:button>
    </form>
</div>