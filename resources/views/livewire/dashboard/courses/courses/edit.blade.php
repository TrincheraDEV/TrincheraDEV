<?php

use App\Models\Course;
use Livewire\Volt\Component;

new class extends Component {
    public Course $course;

    public $title = '';

    public $slug = '';

    public $image = '';

    public $video_id = '';

    public $description = '';

    public $status = '';

    public function mount()
    {
        // $this->title = $this->course->title;
        // $this->slug = $this->course->slug;
        // $this->image = $this->course->image;
        // $this->video_id = $this->course->video_id;
        // $this->description = $this->course->description;
        // $this->status = $this->course->status;
    }

    public function save()
    {
        $this->course->update([
            'title' => $this->title,
            'slug' => $this->slug,
            'image' => $this->image,
            'video_id' => $this->video_id,
            'description' => $this->description,
            'status' => $this->status,
        ]);
    }
}
?>

<div>
    <form wire:submit="save">
        <input type="text" wire:model="title" />
        <input type="text" wire:model="slug" />
        <input type="text" wire:model="image" />
        <input type="text" wire:model="video_id" />
        <input type="text" wire:model="description" />
        <input type="text" wire:model="status" />
        <button type="submit">Save</button>
    </form>
</div>