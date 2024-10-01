<x-frontend-layout>

    <x-frontend.pages.header.header>
        <x-frontend.pages.header.title>
            Courses
        </x-frontend.pages.header.title>

        <x-frontend.pages.header.subtitle>
            We have crafted some of the most complete courses that will help you improve your skills.
        </x-frontend.pages.header.subtitle>
    </x-frontend.pages.header.header>

    <section id="courses">
        <x-frontend.container.container class="max-w-6xl">
            <x-frontend.container.container-inner>
                <x-frontend.container.grid columns="3">
                    @foreach ($courses as $course)
                    <x-frontend.card.card>
                        <x-frontend.card.card-image :href="route('courses.show', $course->slug)" :image="$course->image"
                            :title="'View ' . $course->title" :alt="$course->title" />
                        <x-frontend.card.card-body>
                            <x-frontend.card.card-title :href="route('courses.show', $course->slug)"
                                :title="$course->title" />
                            <x-frontend.card.card-excerpt :excerpt="$course->description" />
                        </x-frontend.card.card-body>
                    </x-frontend.card.card>
                    @endforeach
                </x-frontend.container.grid>
            </x-frontend.container.container-inner>
        </x-frontend.container.container>
    </section>

</x-frontend-layout>