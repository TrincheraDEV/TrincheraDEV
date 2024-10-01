@props(['href', 'title' => '', 'target' => '_self', 'current' => false])

@php
$defaultClasses = 'text-base leading-6 text-gray-600 hover:text-gray-900 hover:underline ';
$defaultClasses .= $current ? 'text-primary font-medium underline hover:text-primary-dark' : '';
@endphp

<a href="{{ $href }}" target="{{ $target }}" {{ $title ? 'title="' . $title . '"' : '' }}
    class="{{ $defaultClasses }} {{ $attributes->get('class') }}">
    {{ $slot }}
</a>