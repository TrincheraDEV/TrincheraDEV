<div {{ $attributes->merge(['class' => 'relative flex flex-col h-full mb-0 pb-0 before:content-[""] before:block
    before:absolute before:left-3 before:-top-1.5 before:w-[calc(100%-24px)] before:h-2.5 before:bg-white
    before:dark:bg-white/10 before:dark:border-white/20 before:border before:border-gray-200 before:-z-10
    after:content-[""] after:block after:absolute after:left-6 after:-top-3 after:w-[calc(100%-48px)]
    after:w-[calc(100%-48px)] after:h-2.5 after:bg-white after:dark:bg-white/10 after:border after:border-gray-200
    after:dark:border-white/20
    after:-z-20']) }}>
    {{ $slot }}
</div>