<section class="max-w-sm mx-auto">
    <div class="p-8 rounded-3xl ring-2 ring-gray-200 xl:p-10">
        <h3 id="tier-startup" class="text-lg font-semibold leading-8 text-gray-600">
            Yearly
        </h3>
        <p class="mt-4 text-sm leading-6 text-left text-gray-600">
            Simple price to access all courses and content.
        </p>
        <p class="flex items-baseline mt-6 gap-x-1">
            <span class="mr-2 text-gray-600 line-through">149 €</span>
            <span class="text-4xl font-bold tracking-tight text-gray-900">
                99 €
            </span>
            <span class="ml-1 text-sm font-semibold leading-6 text-gray-600 lowercase">
                / year
            </span>
        </p>
        <ul role="list" class="mt-4 space-y-3 text-sm leading-6 text-gray-600 xl:mt-8">
            {{-- @foreach ($plan['features'] as $feature)
            <li class="flex gap-x-3">
                <svg class="flex-none w-5 h-6 text-violet-600" viewBox="0 0 20 20" fill="currentColor"
                    aria-hidden="true">
                    <path fill-rule="evenodd"
                        d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                        clip-rule="evenodd"></path>
                </svg>
                {{ $feature }}
            </li>
            @endforeach
            @if ($plan['features_no'])
            @foreach ($plan['features_no'] as $feature)
            <li class="flex text-gray-400 gap-x-3">
                <svg class="h-6 w-5 flex-none
                    {{ $plan['name'] !== 'PRO' ? '' : 'text-gray-600 group-hover:text-violet-600' }}"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
                <span>{!! $feature !!}</span>
            </li>
            @endforeach
            @endif --}}
        </ul>
    </div>
</section>