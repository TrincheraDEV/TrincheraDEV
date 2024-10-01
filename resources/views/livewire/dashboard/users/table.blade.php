<?php

use Livewire\Volt\Component;

new class extends Component {
    
}
?>

<div>

    <!-- Users Table -->
    <flux:table class="mt-6">
        <flux:columns>
            <flux:column>Name</flux:column>
            <flux:column>Email</flux:column>
            <flux:column></flux:column>
        </flux:columns>

        <flux:rows>
            @foreach (App\Models\User::all() as $user)
            <livewire:dashboard.users.user :user="$user" :key="$user->id" />
            @endforeach
        </flux:rows>

    </flux:table>
</div>