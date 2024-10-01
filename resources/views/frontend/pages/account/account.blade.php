<x-frontend-settings-layout>

    @section('settings-content')
    <div class="space-y-12">

        <livewire:frontend.account.update-name-form />

        <flux:separator />

        <livewire:frontend.account.update-password-form />
    </div>
    @endsection

</x-frontend-settings-layout>