<div x-data="{ notificationOpen: false }" class="relative flex items-center">
    {{-- Notification bell --}}
    <button @click="notificationOpen = ! notificationOpen"
            class="flex mx-4 text-gray-600 focus:outline-none">
        <i class="far fa-bell"></i>
    </button>
    <div x-show="notificationOpen" @click="notificationOpen = false"
         class="fixed inset-0 h-full w-full z-10" style="display: none;">
    </div>
    <div x-show="notificationOpen"
         class="absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-xl overflow-hidden z-10 mt-24"
         style="width: 20rem; display: none;">
        <a href="#" class="flex items-center px-4 py-3 text-gray-600 hover:text-white hover:bg-indigo-600 -mx-2">
            <p class="text-sm mx-2">
                <span class="font-bold">
                    Test
                </span>
                    Message
                <span class="font-bold text-indigo-400">
                    Log Action
                </span>
                    Time
            </p>
        </a>
    </div>
</div>
