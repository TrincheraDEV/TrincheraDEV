<?php

use Livewire\Volt\Component;

new Class extends Component {

    public $language = '';

    public function mount()
    {
        $this->language = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 5);
    }
}
?>

<div x-cloak>
    @if($language == 'es-ES')
    <div x-data="{
        bannerVisible: false,
        bannerVisibleAfter: 3000,
        dismissBanner() {
            console.log('dismissBanner');
            this.bannerVisible = false;
            localStorage.setItem('trincheraWPBannerDismissed', 'true');
        }
    }" x-show="bannerVisible" x-transition:enter="transition ease-out duration-500"
        x-transition:enter-start="-translate-y-10" x-transition:enter-end="translate-y-0"
        x-transition:leave="transition ease-in duration-300" x-transition:leave-start="translate-y-0"
        x-transition:leave-end="-translate-y-10" x-init="
        if (localStorage.getItem('trincheraWPBannerDismissed') !== 'true') {
            setTimeout(() => { bannerVisible = true }, bannerVisibleAfter);
        }
    " class="flex items-center justify-between gap-x-6 bg-red-500 px-6 py-2.5 sm:pr-3.5 lg:pl-8">
        <div class="text-sm leading-6 text-white">
            <a href="https://trincherawp.com" target="_blank" title="Visita la web de Trinchera WP"
                class="flex flex-wrap items-center">
                <div><strong class="flex-1 font-semibold">¿Prefieres aprender en Español?</strong></div>
                <svg viewBox="0 0 2 2" class="mx-2 h-0.5 w-0.5 fill-current hidden md:inline" aria-hidden="true">
                    <circle cx="1" cy="1" r="1" />
                </svg>
                <div>Visita la web de Trinchera WP&nbsp;<span aria-hidden="true">&raquo;</span></div>
            </a>
        </div>
        <button type="button" @click="dismissBanner()" class="-m-3 flex-none p-3 focus-visible:outline-offset-[-4px]">
            <span class="sr-only">Dismiss</span>
            <svg class="w-5 h-5 text-white" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path
                    d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z" />
            </svg>
        </button>
    </div>
    @endif
</div>