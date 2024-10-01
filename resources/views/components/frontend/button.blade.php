@php
$element = $attributes->get('element', 'a');
if ($element === 'a' && !$attributes->has('href')) {
$element = 'button';
}

$defaultClasses = 'inline-flex items-center justify-center rounded-md active:bg-black active:text-white font-medium';

$variants = [
'primary' => 'text-white border-2 border-transparent bg-primary hover:bg-primary-dark',
'outline' => 'text-black border-2 border-black bg-transparent hover:bg-black hover:text-white',
];

$sizes = [
'sm' => 'px-2.5 py-1 text-xs',
'md' => 'px-4 py-2 text-sm',
'base' => 'px-5 py-2.5 text-base',
'lg' => 'px-6 py-3 text-base',
'xl' => 'px-8 py-4 text-lg',
];
@endphp

<{{ $element }}
    class="{{ $defaultClasses }} {{ $variants[$attributes->get('variant', 'primary')] }} {{ $sizes[$attributes->get('size', 'base')] }} {{ $attributes->get('class') }}"
    @foreach ($attributes->except(['class', 'variant', 'size', 'element']) as $key => $value)
    {{ $key }}="{{ $value }}"
    @endforeach
    >
    {{ $slot }}
</{{ $element }}>