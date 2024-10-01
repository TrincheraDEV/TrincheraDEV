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
    @fluxStyles
</head>

<body class="font-sans antialiased text-gray-900 bg:white dark:bg-zinc-900">

    <livewire:frontend.banners.trincherawp />

    @include('frontend.partials.header.header')

    <main id="main" class="min-h-screen">
        @yield('content')
        {{ $slot }}
    </main>

    @include('frontend.partials.footer.footer')

    @persist('toast')
    <flux:toast />
    @endpersist

    @fluxScripts
</body>

</html>