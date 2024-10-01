@php
$defaultClasses = 'text-sm font-semibold leading-6 text-gray-400';
@endphp

<h3 class="{{ $defaultClasses }} {{ $attributes->get('class') }}">
    {{ $slot }}
</h3>