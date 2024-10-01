<?php

use Livewire\Volt\Component;

new Class extends Component {

    public string $password;
    public string $password_confirmation;

    public function updatePassword()
    {
        $this->validate([
            'password' => 'required|string|max:255',
        ]);

        auth()->user()->update(['password' => $this->password]);

        Flux::toast('Password updated');
    }
    
}
?>

<form wire:submit="updatePassword" class="space-y-6">
    <div>
        <flux:heading size="lg" level="1">Update password</flux:heading>
        <flux:subheading>You can change your password if you'd like.</flux:subheading>
    </div>

    <flux:input wire:model="password" label="New password" type="password" />
    <flux:input wire:model="password_confirmation" label="Password confirmation" type="password" />

    <div class="flex justify-end">
        <flux:button type="submit" variant="primary">Update password</flux:button>
    </div>
</form>