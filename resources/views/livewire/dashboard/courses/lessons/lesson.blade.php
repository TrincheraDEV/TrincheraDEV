<?php

use App\Models\Lesson;
use Livewire\Volt\Component;

new class extends Component {
    public Lesson $lesson;

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

    // #[Livewire\Attributes\Validate('integer')]
    // public $order;

    public $status;

    public function mount()
    {
        $this->lessons = Lesson::with('sections.course')->get();
        $this->title = $this->lesson->title;
        $this->slug = $this->lesson->slug;
        $this->content = $this->lesson->content;
        $this->image = $this->lesson->image;
        $this->video_id = $this->lesson->video_id;
        // $this->order = $this->lesson->order;
        $this->status = $this->lesson->status;
    }
    public function lessonEdit()
    {
        $this->modal('lesson-edit')->show();
    }

    public function lessonContent()
    {
        $this->modal('lesson-content')->show();
    }

    public function lessonUpdate()
    {
        $this->validate();

        $this->lesson->update([
            'title' => $this->title,
            'slug' => $this->slug,
            'content' => $this->content,
            'image' => $this->image,
            'video_id' => $this->video_id,
            'status' => $this->status->value,
        ]);
        
        $this->modal('lesson-edit')->close();
    }
}
?>

<flux:row>
    <flux:cell variant="strong" class="max-w-[14rem] pr-4 truncate">{{ $lesson->title }}</flux:cell>
    <flux:cell class="max-w-[14rem] pr-4 truncate">
        {{ $lesson->getCourseTitle() }}
    </flux:cell>
    <flux:cell>
        <flux:badge color="{{ $lesson->status->getColor() }}" size="sm" inset="top bottom">
            {{ $lesson->status->getLabel() }}
        </flux:badge>
    </flux:cell>

    <flux:cell>
        <flux:dropdown align="end" offset="-15">
            <flux:button icon="ellipsis-horizontal" size="sm" variant="ghost" inset="top bottom">
            </flux:button>

            <flux:menu class="min-w-32">
                <flux:menu.item icon="pencil-square" wire:click="lessonEdit">Edit</flux:menu.item>
                <flux:menu.item icon="trash" variant="danger" wire:click="remove">Delete</flux:menu.item>
            </flux:menu>
        </flux:dropdown>

        <!-- Modal Lesson » Edit -->
        <flux:modal name="lesson-edit" class="" variant="flyout">
            <div>
                <flux:heading size="lg" level="2">Edit lesson content</flux:heading>
                <flux:subheading>Edit your lesson content here.</flux:subheading>
            </div>

            <form wire:submit="lessonUpdate" class="mt-6 space-y-6">
                <flux:input wire:model="title" label="Title" />
                <flux:input wire:model="image" label="Image" />
                <flux:input wire:model="video_id" label="Video ID" />
                <flux:textarea wire:model="content" label="Content" resize="vertical" class="min-w-[600px]" />
                <flux:input wire:model=" slug" label="Slug" />

                <flux:select wire:model="status" label="Status">
                    @foreach (App\Enums\Status::cases() as $status)
                    <option value="{{ $status->value }}">{{ $status->getLabel() }}</option>
                    @endforeach
                </flux:select>

                <div class="flex">
                    <flux:spacer />

                    <flux:button type="submit" variant="primary">Update lesson</flux:button>
                </div>
            </form>
        </flux:modal>
    </flux:cell>
</flux:row>