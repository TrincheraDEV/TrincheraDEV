@php
$loopIndex = 0;
@endphp

<x-frontend-layout>

    <!-- Course Header -->
    <section class="py-12 bg-secondary">
        <x-frontend.container.container>
            <x-frontend.container.container-inner>

                <h1 class="text-4xl font-semibold text-white">
                    {{ $course->title }}
                </h1>

                <p class="mt-4 text-lg tracking-normal text-white text-balance">
                    {{ $course->description }}
                </p>

                @if(auth()->user()->subscribed('basic') || auth()->user()->id == 1)
                <div class="mt-6">
                    <livewire:frontend.courses.enroll :course="$course" />
                </div>
                @endif
            </x-frontend.container.container-inner>
        </x-frontend.container.container>
    </section>

    <!-- Course Content -->
    <section class="pb-32 bg-gray-100 dark:bg-zinc-900">
        <x-frontend.container.container>
            <x-frontend.container.container-inner>

                <div class="flex flex-col gap-4 divide-y divide-gray-300 dark:divide-zinc-700 md:gap-12 ">
                    @foreach ($sections as $section)
                    <div class="pt-12">
                        <div class="max-w-3xl">
                            <p class="text-sm text-gray-600 dark:text-zinc-300 md:text-lg">
                                Module {{ $loop->index + 1 }}
                            </p>
                            <h2 class="text-lg font-semibold dark:text-white md:text-3xl">{{ $section->title }}</h2>
                            <p class="text-sm text-gray-600 dark:text-zinc-300 md:text-lg">
                                {{ $section->description }}
                            </p>
                        </div>

                        <div class="grid gap-3 pt-6 md:gap-4 md:grid-cols-3">
                            @foreach ($section->lessons as $lesson)
                            @php
                            $lessonIndex = $loopIndex++;
                            @endphp
                            <a href="{{ route('courses.show-lesson', ['courseSlug' => $course->slug, 'lessonSlug' => $lesson->slug]) }}"
                                class="relative p-6 bg-white dark:bg-white/10 rounded-md shadow hover:cursor-pointer hover:bg-white/80
                                dark:hover:bg-white/20
                                {{ $lesson->completions->where('user_id', auth()->id())->isNotEmpty() ? 'border-2 border-primary' : '' }}
                                ">

                                @if ($lesson->completions->where('user_id', auth()->id())->isNotEmpty())
                                <flux:badge color="zinc" size="sm" class="absolute top-0 right-0 rounded-none">
                                    Completed
                                </flux:badge>
                                @endif

                                <div class="text-xs text-gray-500 dark:text-white/70 md:text-sm">
                                    Lesson {{ $loopIndex }}
                                </div>

                                <div class="flex items-center justify-between w-full space-x-6">
                                    <div class="flex items-center gap-2 dark">
                                        <h3 class="text-sm font-medium tracking-tight md:text-base dark:text-white">
                                            {{ $lesson->title }}
                                        </h3>
                                        @if ($lesson->free)
                                        <div
                                            class="inline-flex items-center px-2 py-1 text-xs font-medium text-green-900 bg-green-100 rounded-md ring-1 ring-inset ring-green-600/20">
                                            Free
                                        </div>
                                        @endif
                                    </div>
                                </div>

                            </a>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>

            </x-frontend.container.container-inner>
        </x-frontend.container.container>
    </section>

</x-frontend-layout>