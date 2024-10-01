@props(['href' => null, 'title' => ''])

@php
if ($href) {
$element = 'a';
} else {
$element = 'div';
}
@endphp

<{{ $element }} href="{{ $href }}" title="{{ $title }}" {{ $attributes->merge(['class' => 'block mb-3']) }}>
    <h2
        class="text-base font-semibold leading-tight transition-colors duration-200 text-primary-dark dark:text-white {{ $element === 'a' ? 'hover:underline hover:text-primary' : '' }}">
        {{ $title }}
    </h2>
</{{ $element }}>