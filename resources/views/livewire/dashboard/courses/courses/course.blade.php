<?php

use App\Models\Course;
use Livewire\Volt\Component;
use Illuminate\Support\Facades\Log;

new class extends Component {
    public Course $course;

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

    public $status;

    public $sections = [];
    public $lessons = [];
    public $sectionIndex = 0;
    public $lessonIndex = 0;
    public $courseLessons;
    public $allLessons;

    public $enrollments;

    public function mount()
    {
        $this->title = $this->course->title;
        $this->slug = $this->course->slug;
        $this->description = $this->course->description;
        $this->image = $this->course->image;
        $this->video_id = $this->course->video_id;
        $this->status = $this->course->status;

        $this->enrollments = $this->course->enrollments;
        
        $this->loadSectionsAndLessons();
    }

    private function loadSectionsAndLessons()
    {
        $this->sections = $this->course->sections()->with('lessons')->get()->map(function ($section) {
            return [
                'id' => $section->id,
                'title' => $section->title,
                'description' => $section->description,
                'lessons' => $section->lessons->map(function ($lesson) {
                    return [
                        'id' => $lesson->id,
                        'title' => $lesson->title,
                    ];
                })->toArray(),
            ];
        })->toArray();

        $this->allLessons = \App\Models\Lesson::all(['id', 'title'])->toArray();
    }

    public function edit()
    {
        $this->modal('course-edit')->show();
    }

    public function content()
    {
        $this->modal('course-content')->show();
    }

    public function update()
    {
        $this->validate();

        $this->course->update([
            'title' => $this->title,
            'slug' => $this->slug,
            'description' => $this->description,
            'image' => $this->image,
            'video_id' => $this->video_id,
            'status' => $this->status->value,
        ]);
        
        $this->modal('course-edit')->close();
    }

    public function remove()
    {
        $this->modal('course-delete')->show();
    }

    public function addSection()
    {
        $this->sections[] = [
            'id' => null, // Use null for new sections
            'title' => '',
            'description' => '',
            'lessons' => [],
        ];
    }

    public function removeSection($sectionIndex)
    {
        unset($this->sections[$sectionIndex]);
        $this->sections = array_values($this->sections);
    }

    public function addLesson($sectionIndex)
    {
        $this->sections[$sectionIndex]['lessons'][] = [
            'id' => '',
            'title' => 'New Lesson',
        ];
    }

    public function removeLesson($sectionIndex, $lessonIndex)
    {
        unset($this->sections[$sectionIndex]['lessons'][$lessonIndex]);
        $this->sections[$sectionIndex]['lessons'] = array_values($this->sections[$sectionIndex]['lessons']);
    }

    public function saveContent()
    {
        $existingSectionIds = $this->course->sections->pluck('id')->toArray();
        $updatedSectionIds = collect($this->sections)->pluck('id')->filter()->toArray();

        // Remove sections that are no longer present
        $sectionsToRemove = array_diff($existingSectionIds, $updatedSectionIds);
        $this->course->sections()->whereIn('id', $sectionsToRemove)->delete();

        foreach ($this->sections as $sectionData) {
            $section = $sectionData['id'] 
                ? $this->course->sections()->find($sectionData['id']) 
                : $this->course->sections()->create([
                    'title' => $sectionData['title'],
                    'description' => $sectionData['description'],
                    'order' => $this->course->sections()->count() + 1,
                ]);

            if ($section) {
                $section->update([
                    'title' => $sectionData['title'],
                    'description' => $sectionData['description'],
                ]);

                $lessonIds = [];
                foreach ($sectionData['lessons'] as $index => $lessonData) {
                    if (!empty($lessonData['id'])) {
                        $lessonIds[$lessonData['id']] = ['order' => $index + 1];
                    }
                }

                $section->lessons()->sync($lessonIds);
            }
        }

        $this->loadSectionsAndLessons();
        $this->modal('course-content')->close();
    }

}
?>

<flux:row>
    <flux:cell variant="strong" class="truncate">{{ $course->title }}</flux:cell>

    <flux:cell align="center">{{ $enrollments->count() }}</flux:cell>

    <flux:cell>
        <flux:badge color="{{ $course->status->getColor() }}" size="sm" inset="top bottom">
            {{ $course->status->getLabel() }}
        </flux:badge>
    </flux:cell>

    <flux:cell>
        <flux:dropdown align="end" offset="-15">
            <flux:button icon="ellipsis-horizontal" size="sm" variant="ghost" inset="top bottom">
            </flux:button>

            <flux:menu class="min-w-32">
                <flux:menu.item icon="inbox-stack" wire:click="content">Content</flux:menu.item>
                <flux:menu.item icon="pencil-square" wire:click="edit">Edit</flux:menu.item>
                <flux:menu.item icon="trash" variant="danger" wire:click="remove">Delete</flux:menu.item>
            </flux:menu>
        </flux:dropdown>

        <!-- Modal Course » Edit -->
        <flux:modal name="course-edit" class="" variant="flyout">
            <div>
                <flux:heading size="lg" level="2">Edit course</flux:heading>
                <flux:subheading>Edit your course here.</flux:subheading>
            </div>

            <form wire:submit="update" class="mt-6 space-y-6">
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

                    <flux:button type="submit" variant="primary">Update course</flux:button>
                </div>
            </form>
        </flux:modal>

        <!-- Modal Course » Content -->
        <flux:modal name="course-content" class="" variant="flyout">
            <div>
                <flux:heading size="lg" level="2">Edit course content</flux:heading>
                <flux:subheading>Edit your course content here.</flux:subheading>
            </div>

            <form wire:submit.prevent="saveContent" class="mt-6 space-y-6">
                @foreach ($sections as $sectionIndex => $section)
                <div class="p-4 mb-6 border rounded-lg">
                    <div class="space-y-6">
                        <flux:input wire:model="sections.{{ $sectionIndex }}.title" label="Section: Title" />
                        <flux:textarea wire:model="sections.{{ $sectionIndex }}.description"
                            label="Section: Description" />
                    </div>

                    <div class="mt-4">
                        <flux:heading level="3">Lessons</flux:heading>
                        @foreach ($section['lessons'] as $lessonIndex => $lesson)
                        <div class="flex items-center gap-2 mt-2">
                            <flux:select wire:model="sections.{{ $sectionIndex }}.lessons.{{ $lessonIndex }}.id">
                                <option value="">Select a lesson</option>
                                @foreach ($this->allLessons as $courseLesson)
                                <option value="{{ $courseLesson['id'] }}" {{ $lesson['id']==$courseLesson['id']
                                    ? 'selected' : '' }}>
                                    {{ $courseLesson['title'] }}
                                </option>
                                @endforeach
                            </flux:select>
                            <flux:button wire:click="removeLesson({{ $sectionIndex }}, {{ $lessonIndex }})" icon="trash"
                                size="sm" variant="danger">
                            </flux:button>
                        </div>
                        @endforeach
                        <flux:button wire:click="addLesson({{ $sectionIndex }})" icon="plus" size="sm" class="mt-2">
                            Add Lesson
                        </flux:button>
                    </div>

                    <div class="flex justify-end mt-4">
                        <flux:button wire:click="removeSection({{ $sectionIndex }})" icon="trash" size="sm"
                            variant="danger">
                            Remove Section
                        </flux:button>
                    </div>
                </div>
                @endforeach

                <flux:button wire:click="addSection" icon="plus" size="sm">
                    Add Section
                </flux:button>

                <div class="flex justify-end mt-6">
                    <flux:button type="submit" variant="primary">Save Content</flux:button>
                </div>
            </form>
        </flux:modal>

        <!-- Modal Course » Delete -->
        <flux:modal name="course-delete" class="min-w-[22rem]">
            <form wire:submit="$parent.remove({{ $course->id }})" class="space-y-6">
                <div>
                    <flux:heading size="lg">Delete course?</flux:heading>

                    <flux:subheading>
                        <p>You're about to delete this project.</p>
                        <p>This action cannot be reversed.</p>
                    </flux:subheading>
                </div>

                <div class="flex gap-2">
                    <flux:spacer />

                    <flux:modal.close>
                        <flux:button variant="ghost">Cancel</flux:button>
                    </flux:modal.close>

                    <flux:button type="submit" variant="danger">Delete course</flux:button>
                </div>
            </form>
        </flux:modal>

    </flux:cell>
</flux:row>