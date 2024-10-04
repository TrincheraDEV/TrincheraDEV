<flux:header container class="bg-white dark:bg-zinc-900 !min-h-0 py-2">
    <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

    <flux:brand href="{{ route('home') }}" logo="{{ asset('images/tdev/trincheradev-icon.png') }}" name="Trinchera DEV"
        class="max-lg:hidden dark:hidden" />
    <flux:brand href="{{ route('home') }}" logo="{{ asset('images/tdev/trincheradev-icon.png') }}" name="Trinchera DEV"
        class="max-lg:!hidden hidden dark:flex" />

    @if (app()->environment('local'))
    <flux:badge size="sm" color="blue">Local</flux:badge>
    @endif

    <flux:navbar class="ml-12 -mb-px max-lg:hidden">
        <flux:navbar.item href="/courses">Courses</flux:navbar.item>
    </flux:navbar>

    <flux:spacer />

    <div class="flex gap-x-2">
        @auth
        @if(!auth()->user()->subscribed('basic'))
        <flux:button href="{{ route('pricing') }}" size="sm" variant="ghost" class="!text-zinc-500">
            Pricing
        </flux:button>
        <flux:separator orientation="vertical" />
        @endif
        <flux:dropdown position="top" align="end">
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
                    <flux:navmenu.item href="{{ route('logout') }}"
                        onclick="event.preventDefault(); this.closest('form').submit();"
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
            <flux:button href="#" size="sm" variant="primary">Sign Up</flux:button>
        </div>
        @endif
    </div>
</flux:header>

<flux:sidebar stashable sticky
    class="border-r lg:hidden bg-zinc-50 dark:bg-zinc-900 border-zinc-200 dark:border-zinc-700">
    <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

    <flux:brand href="{{ route('home') }}" logo="{{ asset('images/tdev/trincheradev-icon.png') }}" name="Trinchera DEV"
        class="px-2 dark:hidden" />
    <flux:brand href="{{ route('home') }}" logo="{{ asset('images/tdev/trincheradev-icon.png') }}" name="Trinchera DEV"
        class="hidden px-2 dark:flex" />

    <flux:navlist variant="outline">
        <flux:navlist.item href="/courses">Courses</flux:navlist.item>
    </flux:navlist>

    <flux:spacer />

    <flux:navlist variant="outline">
        @auth
        @if(!auth()->user()->subscribed('basic'))
        <flux:navlist.item href="{{ route('pricing') }}">Pricing</flux:navlist.item>
        @endif
        <flux:navlist.item icon="user" href="/account">Account</flux:navlist.item>
        <form method="POST" name="logout" action="{{ route('logout') }}">
            @csrf
            <flux:navlist.item href="javascript:document.logout.submit()" icon="arrow-right-start-on-rectangle">
                Logout
            </flux:navlist.item>
        </form>
        @else
        <flux:navlist.item href="{{ route('pricing') }}">Pricing</flux:navlist.item>
        <flux:button href="{{ route('login') }}" size="sm" variant="ghost">Log In</flux:button>
        <flux:button href="#" size="sm" variant="primary">Sign Up</flux:button>
        @endif
    </flux:navlist>
</flux:sidebar>