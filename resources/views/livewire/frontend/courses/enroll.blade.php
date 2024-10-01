<?php

use App\Models\Course;
use App\Models\Enrollment;
use Livewire\Volt\Component;

new Class extends Component {
    public Course $course;
    
    public function enroll()
    {
        sleep(1);
        
        Enrollment::create([
            'user_id' => auth()->user()->id,
            'course_id' => $this->course->id,
            'enrolled_at' => now(),
        ]);

        Flux::toast('Enrolled to course successfully');        
    }
}

?>
<div>
    @if(auth()->user())
    @if(!Enrollment::enrolledToCourse($this->course->id, auth()->user()->id))
    <form wire:submit="enroll">
        <flux:button type="submit">
            Enroll to course
        </flux:button>
    </form>
    @endif
    @endif
</div>