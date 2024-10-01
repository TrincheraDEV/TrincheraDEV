<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400..600&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
    @fluxStyles
</head>


<body class="min-h-screen antialiased bg-white dark:bg-zinc-800">

    <flux:sidebar sticky stashable class="border-r bg-zinc-50 dark:bg-zinc-900 border-zinc-200 dark:border-zinc-700">
        <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

        <flux:brand href="#" logo="https://fluxui.dev/img/demo/logo.png" name="Acme Inc." class="px-2 dark:hidden" />
        <flux:brand href="#" logo="https://fluxui.dev/img/demo/dark-mode-logo.png" name="Acme Inc."
            class="hidden px-2 dark:flex" />

        <flux:navlist variant="outline">
            <flux:navlist.item icon="home" href="/dashboard">Home</flux:navlist.item>
            <flux:navlist.item icon="academic-cap" badge="{{ App\Models\Course::count()}}" href="/dashboard/courses">
                Courses
            </flux:navlist.item>
            <flux:navlist.item icon="users" badge="{{ App\Models\User::count()}}" href="/dashboard/users">
                Users
            </flux:navlist.item>
        </flux:navlist>

        <flux:spacer />

    </flux:sidebar>

    <flux:main>
        {{ $slot }}
    </flux:main>

    @persist('toast')
    <flux:toast />
    @endpersist

    @livewireScripts
    @fluxScripts
</body>
















</html>