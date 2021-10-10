{{-- Avatar Button --}}
<div x-data="{ dropdownOpen: false }" class="relative flex items-center">
    <button @click="dropdownOpen = ! dropdownOpen"
            class="relative block h-8 w-8 rounded-full overflow-hidden shadow focus:outline-none">
        <img class="h-full w-full object-cover"
             src="{{asset('/assets/images/profile_icon.svg')}}"
             alt="Your avatar">
    </button>
    <div @click="dropdownOpen = ! dropdownOpen" class="ml-2 text-gray-500 cursor-pointer">
        <span class="hidden sm:inline-flex mr-1">
            {{ Auth::user()->username }}
        </span>
        <i class="fas fa-angle-down align-middle"></i>
    </div>
    <div x-show="dropdownOpen" @click="dropdownOpen = false" class="fixed inset-0 h-full w-full z-10"
         style="display: none;">
    </div>
    <div x-show="dropdownOpen"
         class="absolute right-0 w-48 bg-white rounded-md overflow-hidden shadow-xl z-10 mt-24 border border-custom-indigo"
         style="display: none;">

        {{ $slot }}

    </div>
</div>
