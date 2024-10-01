@props(['href', 'title' => '', 'target' => 'self'])

@php
$defaultClasses = 'text-sm leading-6 hover:underline';
@endphp

<a href="{{ $href }}" target="{{ $target }}" {{ $title ? 'title="' . $title . '"' : '' }}
    class="{{ $defaultClasses }} {{ $attributes->get('class') }}">
    {{ $slot }}
</a>