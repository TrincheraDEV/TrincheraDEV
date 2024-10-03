@extends('layouts.frontend')

@section('content')

<section class="w-full max-w-4xl px-4 pt-10 pb-12 mx-auto sm:px-6 lg:px-8">
    <div class="flex items-start gap-10 max-md:flex-col">
        <div class="min-w-[13rem]">
            <livewire:frontend.account.navigation-menu />
        </div>

        <flux:separator class="md:hidden" />

        <div class="self-stretch flex-1 max-md:pt-6 max-w-[35rem]">
            @yield('settings-content')
        </div>
    </div>
</section>

@endsection