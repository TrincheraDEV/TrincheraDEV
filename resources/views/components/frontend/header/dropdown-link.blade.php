@props(['href' => '#', 'current' => 'false'])

@php
$defaultClasses = 'block w-full px-4 py-2 text-start text-sm font-medium leading-5 text-zinc-800 hover:bg-zinc-800/5
focus:outline-none focus:bg-zinc-800/5 transition duration-150 ease-in-out ';
$defaultClasses .= 'flex items-center gap-2 data-[slot=icon]:*:size-5 ';
$defaultClasses .= $current === 'true' ? 'bg-zinc-800/5' : '';
@endphp
<a href="{{ $href }}" {{ $attributes->merge(['class' => $defaultClasses]) }}>
    {{ $slot }}
</a>