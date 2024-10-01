<?php

use App\Models\User;
use Livewire\Volt\Component;

new class extends Component {
    public User $user;

    #[Livewire\Attributes\Validate('required|string')]
    public $name = '';

    #[Livewire\Attributes\Validate('required|email')]
    public $email = '';

    public function mount()
    {
        $this->name = $this->user->name;
        $this->email = $this->user->email;
    }
}
?>

<flux:row>
    <flux:cell variant="strong">{{ $user->name }}</flux:cell>
    <flux:cell>{{ $user->email }}</flux:cell>
</flux:row>