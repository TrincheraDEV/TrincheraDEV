@php
$lessonCompleted = $lesson->completions->where('user_id', auth()->id())->isNotEmpty();
@endphp

<x-lesson-layout>

    <flux:sidebar sticky stashable class="border-r bg-zinc-50 dark:bg-zinc-900 border-zinc-200 dark:border-zinc-700">
        <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

        @foreach ($course->sections as $section)
        <flux:navlist.group expandable icon="check-circle" heading="{{ $section->title }}" class="hidden lg:grid">
            @foreach ($section->lessons as $sectionLesson)
            <flux:navlist.item id="{{ $sectionLesson->id }}" icon="check-circle"
                href="{{ route('courses.show-lesson', ['courseSlug' => $course->slug, 'lessonSlug' => $sectionLesson->slug]) }}"
                :current="Str::afterLast(url()->current(), 'lessons/') === $sectionLesson->slug"
                class="!gap-1.5 [&>div>svg]:!size-5 [&>div>svg]:stroke-2 [&>div]:truncate
                {{ Str::afterLast(url()->current(), 'lessons/') === $sectionLesson->slug ? '[&>div>svg]:text-primary [&>div]:font-medium' : '[&>div]:font-normal' }}
                {{ $sectionLesson->completions->where('user_id', auth()->id())->isNotEmpty() ? '[&>div>svg]:text-primary' : '[&>div>svg]:!text-zinc-300' }}">
                {{ $sectionLesson->title }}
            </flux:navlist.item>
            @endforeach
        </flux:navlist.group>
        @endforeach

        <flux:spacer />
    </flux:sidebar>

    <flux:main class="!p-0">
        <!-- Lesson -->
        <div class="relative flex flex-col flex-1 overflow-auto bg-zinc-50 dark:bg-zinc-950/50">

            <!-- Lesson Video -->
            <div class="flex justify-center bg-zinc-100 dark:bg-zinc-950/25">
                <div
                    class="w-full max-h-50vh max-w-[1100px] flex items-center justify-center font-medium text-zinc-400 aspect-video shrink-0 bg-transparent">
                    <div
                        class="relative z-0 w-full h-full overflow-hidden transition-all duration-75 ease-in-out aspect-video">
                        @auth
                        @if(auth()->user()->subscribed('basic') || auth()->user()->isAdmin())
                        <iframe src="https://player.vimeo.com/video/{{ $lesson->video_id }}" class="w-full h-full"
                            allow="fullscreen; picture-in-picture;"></iframe>
                        @else
                        <div class="flex flex-col items-center justify-center w-full h-full">
                            <flux:heading size="xl">To access this content:</flux:heading>
                            <flux:button href="{{ route('account.subscription') }}" class="mt-4">
                                Update your subscription
                            </flux:button>
                        </div>
                        @endif
                        @else
                        <div class="flex flex-col items-center justify-center w-full h-full">
                            <flux:heading size="xl">To access this content:</flux:heading>
                            <div class="flex items-center gap-2 mt-4">
                                <flux:button href="{{ route('login') }}" size="sm">
                                    Log In
                                </flux:button>
                                <flux:button href="{{ route('register') }}" size="sm" variant="primary">
                                    Sign Up
                                </flux:button>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Lesson Title -->
            <div class="border-t border-b border-black/10 dark:border-white/10">
                <div class="w-full max-w-[1148px] mx-auto px-4 md:px-6 py-2 md:py-3 relative tracking-tight">
                    <div class="flex items-center justify-between gap-6">
                        <div>
                            <div class="text-xs md:text-[13px] leading-3 md:leading-5 text-zinc-500 pt-1">
                                {{ $lesson->sections[0]->title }}
                            </div>
                            <div class="flex items-center gap-2">
                                <div class="text-xl font-semibold md:text-3xl text-zinc-950 dark:text-zinc-50 md:pb-1">
                                    {{ $lesson->title }}
                                </div>
                            </div>
                        </div>

                        @auth
                        <div>
                            @if ($lessonCompleted)
                            <flux:badge color="green">Completed</flux:badge>
                            @elseif (App\Models\Enrollment::enrolledToCourse($course->id, auth()->user()->id) &&
                            auth()->user()->subscribed('basic'))
                            <livewire:frontend.lessons.complete :lesson="$lesson" />
                            @else
                            @if(auth()->user()->subscribed('basic'))
                            <livewire:frontend.courses.enroll :course="$course" />
                            @endif
                            @endif
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Lesson Body -->
            <div
                class="flex-1 w-full max-w-[1148px] mx-auto px-4 md:px-6 py-2.5 md:pt-4 lg:pb-96 md:pb-48 pb-24 grid grid-cols-12 gap-6">

                <!-- Lesson Sidebar -->
                <div class="order-2 col-span-12 md:col-span-4">

                    @auth
                    @if(!auth()->user()->subscribed('basic') || !auth()->user()->isAdmin())
                    <!-- Buy -->
                    <x-frontend.lessons.block>
                        <x-slot:title>
                            Get access to all courses!
                        </x-slot:title>
                        <div class="flex gap-2 mt-2">
                            <div class="flex items-end gap-x-2 text-zinc-900 dark:text-white">
                                <div class="text-4xl font-semibold tracking-tight">
                                    99 <span class="text-2xl">€</span>
                                </div>
                            </div>
                        </div>

                        <flux:button href="{{ route('account.subscription') }}" class="w-full mt-4" variant="primary">
                            Update your subscription
                        </flux:button>
                    </x-frontend.lessons.block>
                    @endif
                    @endif

                    @guest
                    <!-- Buy -->
                    <x-frontend.lessons.block>
                        <x-slot:title>
                            Get access to all courses!
                        </x-slot:title>
                        <div class="flex gap-2 mt-2">
                            <div class="flex items-end gap-x-2 text-zinc-900 dark:text-white">
                                <div class="text-4xl font-semibold tracking-tight">
                                    99 <span class="text-2xl">€</span>
                                </div>
                            </div>
                        </div>

                        <flux:button href="{{ route('register') }}" class="w-full mt-4" variant="primary">
                            Sign up now
                        </flux:button>
                    </x-frontend.lessons.block>
                    @endif

                </div>

                <!-- Lesson Content -->
                <div id="lesson-content"
                    class="col-span-12 mt-2 text-sm prose md:col-span-8 lg:col-span-8 md:text-base text-zinc-900 dark:text-zinc-300">
                    {!! Str::markdown($lesson->content) !!}
                </div>
            </div>
        </div>
    </flux:main>

</x-lesson-layout>