<header class="flex justify-between items-center py-4 px-6 bg-white border-b-4 border-indigo-600">
    <div class="flex items-center">
        <x-layouts.search></x-layouts.search>
    </div>
    <div class="flex items-center">
        <x-layouts.notification></x-layouts.notification>
        <x-layouts.user-nav-menu>
            <a href="#"
               class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-600 hover:text-white">
                <span><i class="fas fa-user"></i></span>
                <span class="mx-3">{{__('Προφίλ')}}</span>
            </a>
            <!-- Authentication -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="{{route('logout')}}"
                   class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-600 hover:text-white"
                   onclick="event.preventDefault(); this.closest('form').submit();">
                    <span><i class="fas fa-power-off"></i></span>
                    <span class="mx-3">{{__('Αποσύνδεση')}}</span>
                </a>
            </form>
        </x-layouts.user-nav-menu>
    </div>
</header>
