{{--@dd(Illuminate\Support\Facades\Route::currentRouteName())--}}
<div x-data="{ sidebarOpen:false }" class="h-screen flex">
    <div :class="sidebarOpen ? 'block' : 'hidden'"
         @click="sidebarOpen = false"
         class="fixed z-20 inset-0 bg-black opacity-50 transition-opacity lg:hidden hidden">
    </div>
    <div :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'"
         class="fixed z-30 inset-y-0 left-0 w-56 transition duration-300 transform bg-gray-900
         overflow-y-auto lg:translate-x-0 lg:static lg:inset-0 -translate-x-full ease-in">
        <div class="flex items-center justify-center mt-8">
            <div class="flex items-center">
                <a href="{{route('dashboard')}}" class="text-white text-2xl mx-2 font-semibold">
                    {{__('eProtocol')}}
                </a>
            </div>
        </div>
        <nav class="mt-10">
            <a class="flex items-center mt-4 py-2 px-6 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
               href="{{route('dashboard')}}">
                <span class="mx-3">{{__('Dashboard')}}</span>
            </a>
            <a class="flex items-center mt-4 py-2 px-6 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
               href="{{route('protocols.create')}}">
                <span class="mx-3">{{__('Incoming Protocol')}}</span>
            </a>
            <a class="flex items-center mt-4 py-2 px-6 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
               href="#">
                <span class="mx-3">{{__('Outgoing Protocol')}}</span>
            </a>
            <a class="flex items-center mt-4 py-2 px-6 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
               href="#">
                <span class="mx-3">{{__('Records')}}</span>
            </a>
            <a class="flex items-center mt-4 py-2 px-6 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
               href="{{route('activity')}}">
                <span class="mx-3">{{__('Activity Log')}}</span>
            </a>
        </nav>
    </div>
</div>
