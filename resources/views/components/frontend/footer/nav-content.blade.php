@php
$defaultClasses = 'flex flex-col mt-6 space-y-4';
@endphp

<div class="{{ $defaultClasses }} {{ $attributes->get('class') }}">
    {{ $slot }}
</div>