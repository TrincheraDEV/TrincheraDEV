<?php

use Livewire\Volt\Component;

new Class extends Component {

    public string $name;

    public function mount()
    {
        $this->name = auth()->user()->name;
    }

    public function updateName()
    {
        $this->validate([
            'name' => 'required|string|max:255',
        ]);

        auth()->user()->update(['name' => $this->name]);

        Flux::toast('Name updated');
    }
    
}
?>

<form wire:submit="updateName" class="space-y-6">
    <div>
        <flux:heading size="lg" level="1">Account details</flux:heading>
        <flux:subheading>Update your profile information.</flux:subheading>
    </div>

    <flux:input readonly variant="filled" type="email" label="Email" value="{{ auth()->user()->email }}" />
    <flux:input wire:model="name" label="Name" />

    <div class="flex justify-end">
        <flux:button type="submit" variant="primary">Save name</flux:button>
    </div>
</form>