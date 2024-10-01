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

    #[Livewire\Attributes\Renderless]
    public function add()
    {
        //
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

        Flux::toast('Course created successfully');
    }
}
?>

<form wire:submit="save" class="grid max-w-5xl grid-cols-12 gap-16 mt-6">
    <div class="col-span-7">
        <flux:card class="space-y-6">
            <flux:input wire:model="title" label="Title" />
            <flux:input wire:model="image" label="Image" />
            <flux:input wire:model="video_id" label="Video ID" />
            <flux:textarea wire:model="description" label="Description" resize="vertical" />
        </flux:card>
    </div>

    <div class="col-span-4 space-y-6">
        <flux:card class="space-y-6">
            <flux:input wire:model="slug" label="Slug" />

            <flux:select wire:model="status" label="Status">
                @foreach (App\Enums\Status::cases() as $status)
                <option value="{{ $status->value }}">{{ $status->getLabel() }}</option>
                @endforeach
            </flux:select>
        </flux:card>

        <flux:button type="submit" variant="primary">Create course</flux:button>
    </div>
</form>