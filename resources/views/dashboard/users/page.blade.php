<x-app-layout>

    <div class="flex items-center justify-between">
        <div>
            <flux:heading size="xl" level="1">Users</flux:heading>
            <flux:subheading>Manage users here.</flux:subheading>
        </div>

        <flux:modal.trigger name="user-add">
            <flux:button icon="user-plus" size="sm">Add User</flux:button>
        </flux:modal.trigger>
    </div>

    <livewire:dashboard.users.table />

</x-app-layout>