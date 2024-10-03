<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Trinchera DEV') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @fluxStyles
</head>

<body class="min-h-screen bg-white dark:bg-zinc-800">

    <flux:header sticky class="!px-4 bg-white border-b dark:bg-zinc-900 border-zinc-200 dark:border-zinc-700">
        <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

        <flux:brand href="/" name="Trinchera DEV" class="max-lg:hidden dark:hidden" />
        <flux:brand href="/" name="Trinchera DEV" class="max-lg:!hidden hidden dark:flex" />

        <flux:spacer />

        <div class="flex items-center gap-2">
            <flux:button href="{{ config('app.url') . '/' . Str::before(request()->path(), 'lessons/') }}" size="sm"
                variant="ghost">
                Exit course
            </flux:button>
            @auth
            @else
            <flux:button href="{{ route('login') }}" size="sm">
                Log In
            </flux:button>
            <flux:button href="{{ route('register') }}" size="sm" variant="primary">
                Sign Up
            </flux:button>
            @endif
        </div>
    </flux:header>

    {{ $slot }}

    @persist('toast')
    <flux:toast />
    @endpersist

    @fluxScripts

    @if (app()->environment() === 'production')
    @if (auth()->check() && auth()->user()->id !== 1)
    @else
    @include('frontend.scripts.activecampaign')
    @include('frontend.scripts.simple-analytics')
    @endif
    @endif
</body>

</html>