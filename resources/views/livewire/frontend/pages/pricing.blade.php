<?php

use Livewire\Volt\Component;

new Class extends Component {    
}
?>

<div class="overflow-hidden bg-white border-2 rounded-lg dark:bg-white/10 border-zinc-200 dark:border-white/20 md:transform md:-translate-y-10 md:-mb-10 md:shadow-md md:hover:shadow-xl md:transition-all md:duration-500 md:border"
    data-primary="primary" data-rounded="rounded-lg" data-rounded-max="rounded-full">
    <div class="p-5 md:p-8">
        <div class="flex items-baseline justify-between mb-4">
            <h4 class="text-xl font-bold lg:text-2xl dark:text-white">Anual</h4>
            <span class="text-xl font-bold lg:text-2xl dark:text-white">99 €
                <span class="ml-1 text-xs font-normal text-zinc-700 dark:text-white/70">/ year</span>
            </span>
        </div>
        <p class="mb-6 text-gray-500 dark:text-white/70">
            Straight forward to the important things... all the content and courses for one price.
        </p>
        @auth
        <flux:button href="{{ route('account.subscription') }}" variant="primary">
            Select plan
        </flux:button>
        @else
        <flux:button href="#register" variant="primary">
            Select plan
        </flux:button>
        @endauth
    </div>
</div>