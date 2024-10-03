<div class="py-16">
    <div class="xl:grid xl:grid-cols-3 xl:gap-8">

        <!-- Project -->
        <div>
            <img class="h-7" src="{{ asset('images/tdev/trincheradev-icon.png') }}" alt="{{ config('app.name') }}">

            <p class="my-3 text-sm leading-6 text-gray-300">
                Learn the skills you need to build and launch your own projects. Get access and start
                learning today.
            </p>
        </div>

        <!-- Menus -->
        <div class="grid grid-cols-3 gap-8 mt-16 text-white xl:col-span-2 xl:mt-0">

            <!-- Links -->
            <nav>
                <x-frontend.footer.nav-title>
                    Links
                </x-frontend.footer.nav-title>

                <x-frontend.footer.nav-content>
                    <x-frontend.footer.nav-item href="{{ route('courses') }}" target="_self">
                        Courses
                    </x-frontend.footer.nav-item>

                    <x-frontend.footer.nav-item href="{{ route('pricing') }}" target="_self">
                        Pricing
                    </x-frontend.footer.nav-item>
                </x-frontend.footer.nav-content>
            </nav>

            <!-- Extras -->
            <nav>
                <x-frontend.footer.nav-title>
                    Legal
                </x-frontend.footer.nav-title>

                <x-frontend.footer.nav-content>
                    <x-frontend.footer.nav-item href="#" target="_self">
                        Terms of service
                    </x-frontend.footer.nav-item>

                    <x-frontend.footer.nav-item href="#" target="_self">
                        Privacy policy
                    </x-frontend.footer.nav-item>
                </x-frontend.footer.nav-content>
            </nav>

            <!-- More -->
            <nav>
                <x-frontend.footer.nav-title>
                    More
                </x-frontend.footer.nav-title>

                <x-frontend.footer.nav-content>
                    <x-frontend.footer.nav-item href="https://prolinks.pro/" target="_blank">
                        PROlinks
                    </x-frontend.footer.nav-item>

                    <x-frontend.footer.nav-item href="https://trincherawp.com" target="_blank">
                        Trinchera WP <span class="text-xs italic text-gray-400">(Spanish)</span>
                    </x-frontend.footer.nav-item>
                </x-frontend.footer.nav-content>
            </nav>

        </div>
    </div>
</div>