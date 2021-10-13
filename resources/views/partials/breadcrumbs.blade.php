@unless ($breadcrumbs->isEmpty())
    <nav class="mx-4">
        <ul class="px-4 py-2 rounded flex bg-white text-gray-500 text-sm lg:text-base">
            @foreach ($breadcrumbs as $breadcrumb)

                @if ($breadcrumb->url && !$loop->last)
                    <li class="inline-flex items-center">
                        <a href="{{ $breadcrumb->url }}" class="text-blue-600 hover:text-blue-900 hover:underline focus:text-blue-900 focus:underline">
                            {{ $breadcrumb->title }}
                        </a>
                    </li>
                @else
                    <li class="inline-flex items-center">
                        {{ $breadcrumb->title }}
                    </li>
                @endif

                @unless($loop->last)
                    <li class="inline-flex items-center text-gray-500 px-2">
                        /
                    </li>
                @endif

            @endforeach
        </ul>
    </nav>
@endunless



{{--<ul class="flex text-gray-500 text-sm lg:text-base">--}}
{{--    <li class="inline-flex items-center">--}}
{{--        <a href="/">Home</a>--}}
{{--        <svg--}}
{{--            class="h-5 w-auto text-gray-400"--}}
{{--            fill="currentColor"--}}
{{--            viewBox="0 0 20 20"--}}
{{--        >--}}
{{--            <path--}}
{{--                fill-rule="evenodd"--}}
{{--                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"--}}
{{--                clip-rule="evenodd"--}}
{{--            ></path>--}}
{{--        </svg>--}}
{{--    </li>--}}
{{--    <li class="inline-flex items-center">--}}
{{--        <a href="/components">Components</a>--}}
{{--        <svg--}}
{{--            class="h-5 w-auto text-gray-400"--}}
{{--            fill="currentColor"--}}
{{--            viewBox="0 0 20 20"--}}
{{--        >--}}
{{--            <path--}}
{{--                fill-rule="evenodd"--}}
{{--                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"--}}
{{--                clip-rule="evenodd"--}}
{{--            ></path>--}}
{{--        </svg>--}}
{{--    </li>--}}
{{--    <li class="inline-flex items-center">--}}
{{--        <a href="#" class="text-teal-400">Breadcrumb</a>--}}
{{--    </li>--}}
{{--</ul>--}}
