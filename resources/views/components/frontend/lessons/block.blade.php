<div
    class="block p-4 rounded-md mb-4 bg-white dark:bg-zinc-200/5 hover:bg-zinc-100/50 dark:hover:bg-white/[6%] mt-2 md:mt-4 border dark:border-white/[3%] border-black/5 shadow-sm">

    @if ( isset($title) )
    <h4 class="text-lg font-medium tracking-tight lg:text-lg dark:text-zinc-50 text-zinc-900">
        {{ $title }}
    </h4>
    @endif

    {{ $slot }}
</div>