@props(['columns' => '3', 'class' => ''])

@php
if ( $columns == '2' ) {
$md = 'md:grid-cols-2';
} elseif ( $columns == '3' ) {
$md = 'md:grid-cols-2 lg:grid-cols-3';
} elseif ( $columns == '4' ) {
$md = 'md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4';
}
@endphp


<div class="grid gap-x-8 gap-y-12 sm:gap-y-16 {{ $md }} {{ $class }}">
    {{ $slot }}
</div>