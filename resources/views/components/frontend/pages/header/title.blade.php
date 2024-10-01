@props(['level' => 'h1'])

<{{ $level }} {{ $attributes->merge(['class' => 'font-medium text-3xl tracking-tight text-slate-900 dark:text-white
    sm:text-4xl text-balance']) }}>
    {{ $slot }}
</{{ $level }}>