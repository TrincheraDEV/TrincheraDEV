<header class="w-full px-8 text-gray-700 bg-white dark:bg-zinc-900">
    <x-frontend.container.container>
        <x-frontend.container.container-inner>

            <div class="flex flex-col flex-wrap items-center justify-between py-5 mx-auto md:flex-row">

                <div class="relative flex flex-col items-center md:flex-row">

                    <!-- Logo -->
                    <a href="{{ route('home') }}"
                        class="flex items-center mb-5 font-medium text-gray-900 dark:text-white lg:w-auto lg:items-center lg:justify-center md:mb-0">
                        <span class="mx-auto text-xl font-bold leading-none text-gray-900 select-none dark:text-white">
                            {{ config('app.name') }}
                        </span>
                    </a>

                    <!-- Navigation Links -->
                    <nav class="flex flex-wrap items-center mb-5 text-sm md:mb-0 md:pl-8 md:ml-8 gap-x-12">
                        <flux:navbar class="gap-x-6">
                            <flux:navbar.item href="/courses" class="[&>:first-child]:text-base">
                                Courses
                            </flux:navbar.item>
                        </flux:navbar>
                    </nav>
                </div>

                <div class="flex gap-x-2">
                    @auth
                    @if(!auth()->user()->subscribed('basic'))
                    <flux:button href="{{ route('pricing') }}" size="sm" variant="ghost" class="!text-zinc-500">
                        Pricing
                    </flux:button>
                    <flux:separator orientation="vertical" />
                    @endif
                    <flux:dropdown>
                        <flux:navbar.item icon-trailing="chevron-down">Account</flux:navbar.item>

                        <flux:navmenu class="space-y-1.5">

                            <div class="px-2 py-1.5">
                                <flux:subheading size="sm">Signed in as</flux:subheading>
                                <flux:heading class="!mt-1 truncate">{{ auth()->user()->email }}</flux:heading>
                            </div>

                            <flux:separator class="-mx-[.3125rem] my-[.3125rem]" />

                            <flux:navmenu.item href="/account" icon="user">Account</flux:navmenu.item>

                            <flux:separator class="-mx-[.3125rem] my-[.3125rem]" />

                            <form method="POST" name="logout" action="{{ route('logout') }}">
                                @csrf
                                <flux:navmenu.item href="javascript:document.logout.submit()"
                                    icon="arrow-right-start-on-rectangle">
                                    Logout
                                </flux:navmenu.item>
                            </form>

                        </flux:navmenu>
                    </flux:dropdown>
                    @else
                    <div class="flex gap-x-2">
                        <flux:button href="{{ route('pricing') }}" size="sm" variant="ghost" class="!text-zinc-500">
                            Pricing
                        </flux:button>
                        <flux:separator orientation="vertical" />
                        <flux:button href="{{ route('login') }}" size="sm" variant="ghost">Log In</flux:button>
                        <flux:button href="{{ route('register') }}" size="sm" variant="primary">Sign Up</flux:button>
                    </div>
                    @endif
                </div>

            </div>

        </x-frontend.container.container-inner>
    </x-frontend.container.container>
</header>