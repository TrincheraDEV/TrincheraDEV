<?php

use App\Models\Course;
use App\Models\Enrollment;
use Livewire\Volt\Component;

new Class extends Component {
    public Course $course;
    public $isEnrolled = false;

    public function mount()
    {
        $this->isEnrolled = Enrollment::enrolledToCourse($this->course->id, auth()->id());
    }
    
    public function enroll()
    {
        sleep(1);
        
        Enrollment::create([
            'user_id' => auth()->user()->id,
            'course_id' => $this->course->id,
            'enrolled_at' => now(),
        ]);

        Flux::toast('Enrolled to course successfully');
        
        return redirect(request()->header('Referer'));
    }
}

?>
<div>
    <form wire:submit="enroll">
        <flux:button type="submit">
            Enroll to course
        </flux:button>
    </form>
</div>