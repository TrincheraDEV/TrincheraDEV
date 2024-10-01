@props(['href' => null, 'title' => '', 'image' => '', 'alt' => ''])

@php
if ($href) {
$element = 'a';
} else {
$element = 'div';
}
@endphp

<div class="flex-shrink-0 border border-b-0 border-gray-200 dark:border-white/20">
    <figure class="h-56 sm:h-64">
        <{{ $element}} href="{{ $href }}" title="{{ $title}}" class="block h-full overflow-hidden group">
            <img src="{{ $image }}" class="object-cover w-full h-full" alt="{{ $alt }}">
        </{{ $element }}>
    </figure>
</div>