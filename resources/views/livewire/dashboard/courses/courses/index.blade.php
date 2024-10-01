<?php

use Livewire\Volt\Component;

new class extends Component {

    #[Livewire\Attributes\Validate('string|required')]
    public $title = '';

    #[Livewire\Attributes\Validate('string|required')]
    public $slug = '';

    #[Livewire\Attributes\Validate('string')]
    public $image = '';

    #[Livewire\Attributes\Validate('string')]
    public $video_id = '';

    #[Livewire\Attributes\Validate('string')]
    public $description = '';

    #[Livewire\Attributes\Validate('integer')]
    public int $status = 1;

    public function remove($id)
    {
        App\Models\Course::findOrFail($id)->delete();

        $this->modal('course-delete')->close();

        Flux::toast('Course deleted successfully');
    }

    public function save()
    {
        $this->validate();

        App\Models\Course::create([
            'title' => $this->title,
            'slug' => $this->slug,
            'image' => $this->image,
            'video_id' => $this->video_id,
            'description' => $this->description,
            'status' => $this->status,
        ]);

        $this->modal('course-add')->close();

        Flux::toast('Course created successfully');
    }
};
?>

<div>
    <div>
        <div class="flex items-center gap-x-4">
            <flux:heading size="xl" level="1">Courses</flux:heading>

            <flux:modal.trigger name="course-add">
                <flux:button icon="plus" size="xs">Add Course</flux:button>
            </flux:modal.trigger>
        </div>
        <flux:subheading>Manage your courses here.</flux:subheading>
    </div>

    <!-- Courses Table -->
    <flux:table class="mt-6">
        <flux:columns>
            <flux:column>Title</flux:column>
            <flux:column>Enrollments</flux:column>
            <flux:column>Status</flux:column>
            <flux:column></flux:column>
        </flux:columns>

        <flux:rows>
            @foreach (App\Models\Course::all() as $course)
            <livewire:dashboard.courses.courses.course :course="$course" :key="$course->id" />
            @endforeach
        </flux:rows>

    </flux:table>

    <!-- Modal Course » Add -->
    <flux:modal name="course-add" class="" variant="flyout">
        <div>
            <flux:heading size="lg" level="2">Add course</flux:heading>
            <flux:subheading>Add your course here.</flux:subheading>
        </div>

        <form wire:submit="save" class="mt-6 space-y-6">
            <flux:input wire:model="title" label="Title" />
            <flux:input wire:model="image" label="Image" />
            <flux:input wire:model="video_id" label="Video ID" />
            <flux:textarea wire:model="description" label="Description" resize="vertical" />
            <flux:input wire:model="slug" label="Slug" />

            <flux:select wire:model="status" label="Status">
                @foreach (App\Enums\Status::cases() as $status)
                <option value="{{ $status->value }}">{{ $status->getLabel() }}</option>
                @endforeach
            </flux:select>

            <div class="flex">
                <flux:spacer />

                <flux:button type="submit" variant="primary">Create course</flux:button>
            </div>
        </form>
    </flux:modal>

</div>