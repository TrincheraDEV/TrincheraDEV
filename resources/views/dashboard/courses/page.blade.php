<x-app-layout>

    <div class="flex items-center gap-4">
        <flux:heading size="xl" level="1">Courses</flux:heading>
    </div>

    <flux:tab.group variant="flush" class="mt-4">
        <flux:tabs>
            <flux:tab name="courses">Courses</flux:tab>
            <flux:tab name="lessons">Lessons</flux:tab>
        </flux:tabs>

        <flux:tab.panel name="courses" class="max-w-4xl">
            <livewire:dashboard.courses.courses.index />
        </flux:tab.panel>

        <flux:tab.panel name="lessons" class="max-w-2xl">
            <livewire:dashboard.courses.lessons.index />
        </flux:tab.panel>
    </flux:tab.group>

</x-app-layout>