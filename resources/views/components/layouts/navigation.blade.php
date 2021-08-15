<div class="top_navbar justify-between">
    <div class="flex items-center">
        <div class="hamburger">
            <div class="hamburger__inner">
                <i class="fas fa-bars text-indigo-600"></i>
            </div>
        </div>
        <x-layouts.search></x-layouts.search>
    </div>
    <div class="flex">
        <x-layouts.language class="relative"></x-layouts.language>
        <x-layouts.user-nav-menu>
            <a href="{{route('profile.show')}}"
               class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-600 hover:text-white">
                <span><i class="fas fa-user"></i></span>
                <span class="mx-3">{{__('app.profile')}}</span>
            </a>
            <!-- Authentication -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="{{route('logout')}}"
                   class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-600 hover:text-white"
                   onclick="event.preventDefault(); this.closest('form').submit();">
                    <span><i class="fas fa-power-off"></i></span>
                    <span class="mx-3">{{__('app.logout')}}</span>
                </a>
            </form>
        </x-layouts.user-nav-menu>
    </div>
</div>
