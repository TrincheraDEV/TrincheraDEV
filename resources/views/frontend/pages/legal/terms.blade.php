<x-frontend-layout>
    <div class="pt-4 pb-12 bg-gray-100 dark:bg-gray-900">
        <div
            class="w-full p-6 mx-auto mt-6 overflow-hidden prose bg-white shadow-md sm:max-w-2xl dark:bg-gray-800 sm:rounded-lg dark:prose-invert">
            {!! Str::markdown($termsContent) !!}
        </div>
    </div>
</x-frontend-layout>