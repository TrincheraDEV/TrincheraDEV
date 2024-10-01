<?php

use Livewire\Volt\Component;
use Livewire\WithPagination;
use App\Models\Lesson;
use App\Models\Course;
use App\Enums\Status;

new class extends Component {
    use WithPagination;

    #[Livewire\Attributes\Validate('string|required')]
    public $title = '';

    #[Livewire\Attributes\Validate('string|required')]
    public $slug = '';

    #[Livewire\Attributes\Validate('string')]
    public $image = '';

    #[Livewire\Attributes\Validate('string')]
    public $video_id = '';

    #[Livewire\Attributes\Validate('string')]
    public $content = '';

    public int $status = 1;

    public $courses = [];
    public $lessons = [];
    public $lesson = null;
    public $search = '';
    public $selectedCourse = null;
    public $selectedStatus = null;

    public function mount()
    {
        $this->selectedStatus = null;
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedSelectedCourse()
    {
        $this->resetPage();
    }

    public function updatedSelectedStatus()
    {
        $this->resetPage();
    }

    public function with(): array
    {
        $lessons = $this->getLessons();

        return [
            'lessons' => $lessons,
            'courses' => Course::all(),
            'statuses' => Status::cases(),
        ];
    }

    private function getLessons()
    {
        $query = Lesson::query();

        if ($this->search) {
            $query->where('lessons.title', 'like', '%' . $this->search . '%');
        }

        if ($this->selectedStatus !== null && $this->selectedStatus !== '') {
            $query->where('lessons.status', $this->selectedStatus);
        }

        return $query->paginate(20);
    }

    public function save()
    {
        $this->validate();

        App\Models\Lesson::create([
            'title' => $this->title,
            'slug' => $this->slug,
            'image' => $this->image,
            'video_id' => $this->video_id,
            'content' => $this->content,
            'status' => $this->status,
        ]);

        $this->modal('lesson-add')->close();

        Flux::toast('Lesson created successfully');
    }
}; ?>

<div>
    <div class="flex items-center justify-between">
        <div>
            <flux:heading size="xl" level="1">Lessons</flux:heading>
            <flux:subheading>Manage your lessons here.</flux:subheading>
        </div>

        <flux:modal.trigger name="lesson-add">
            <flux:button icon="plus" size="sm">Add Lesson</flux:button>
        </flux:modal.trigger>
    </div>

    <!-- Search and Filters -->
    <div class="flex mt-4 space-x-4">
        <flux:input wire:model.live="search" placeholder="Search lessons..." />
        <flux:select wire:model.live="selectedStatus">
            <option value="">All Statuses</option>
            @foreach (App\Enums\Status::cases() as $status)
            <option value="{{ $status->value }}">{{ $status->getLabel() }}</option>
            @endforeach
        </flux:select>
    </div>

    <!-- Lessons Table -->
    <flux:table class="mt-6">
        <flux:columns>
            <flux:column>Title</flux:column>
            <flux:column>Course</flux:column>
            <flux:column>Status</flux:column>
            <flux:column></flux:column>
        </flux:columns>

        <flux:rows>
            @foreach ($this->getLessons() as $lesson)
            <livewire:dashboard.courses.lessons.lesson :lesson="$lesson" :key="$lesson->id" />
            @endforeach
        </flux:rows>
    </flux:table>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $this->getLessons()->links() }}
    </div>

    <!-- Modal Lesson » Add -->
    <flux:modal name="lesson-add" class="" variant="flyout">
        <div>
            <flux:heading size="lg" level="2">Add lesson</flux:heading>
            <flux:subheading>Add your lesson here.</flux:subheading>
        </div>

        <form wire:submit="save" class="mt-6 space-y-6">
            <flux:input wire:model="title" label="Title" />
            <flux:input wire:model="image" label="Image" />
            <flux:input wire:model="video_id" label="Video ID" />
            <flux:textarea wire:model="content" label="Content" resize="vertical" />
            <flux:input wire:model="slug" label="Slug" />

            <flux:select wire:model="status" label="Status">
                @foreach (App\Enums\Status::cases() as $status)
                <option value="{{ $status->value }}">{{ $status->getLabel() }}</option>
                @endforeach
            </flux:select>

            <div class="flex">
                <flux:spacer />

                <flux:button type="submit" variant="primary">Create lesson</flux:button>
            </div>
        </form>
    </flux:modal>
</div>