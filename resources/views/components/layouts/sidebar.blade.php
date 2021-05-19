<div x-data="{ sidebarOpen:false }" class="h-auto flex">
    <div :class="sidebarOpen ? 'block' : 'hidden'"
         @click="sidebarOpen = false"
         class="fixed z-10 inset-0 bg-black opacity-50 transition-opacity lg:hidden hidden">
    </div>
    <div :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'"
         class="fixed z-20 inset-y-0 left-0 w-56 transition duration-300 transform bg-gray-900
         overflow-y-auto lg:translate-x-0 lg:static lg:inset-0 -translate-x-full ease-in">
        <div class="flex items-center justify-center mt-8">
            <div class="flex items-center">
                <a href="{{route('dashboard')}}" class="text-white text-2xl mx-2 font-semibold">
                    {{__('app.eProtocol')}}
                </a>
            </div>
        </div>
        <nav class="mt-10">
            <ul class="text-gray-400">
                <li>
                    <a class="flex items-center mt-4 py-2 px-4 hover:bg-gray-700 hover:bg-opacity-50 hover:text-gray-100
                        {{request()->is('dashboard')? 'bg-gray-600 text-white' : ''}}"
                       href="{{route('dashboard')}}">
                        <span>
                            <i class="fas fa-tachometer-alt"></i>
                        </span>
                        <span class="mx-3">{{__('app.dashboard')}}</span>
                    </a>
                </li>
                <li x-data="{selected:null}">
                    <div class="flex items-center mt-4 py-2 px-4 hover:bg-gray-700 hover:bg-opacity-50 hover:text-gray-100">
                        <span><i class="fas fa-file-alt"></i></span>
                        <span class="mx-4 cursor-pointer"
                              @click="selected !== 0 ? selected = 0 : selected = null">{{__("app.protocol")}}</span>
                    </div>
                    <div x-show="selected == 0" class="bg-gray-800">
                        <a class="flex items-center mt-4 py-2 px-10 hover:bg-gray-700 hover:bg-opacity-50 hover:text-gray-100
                            {{request()->is('protocol/create/ingoing')? 'bg-gray-600 text-white' : ''}}"
                           href="{{route('protocol.create',['type' => 'ingoing'])}}">
                            <span><i class="fas fa-file-import"></i></span>
                            <span class="mx-3">{{__('app.ingoing')}}</span>
                        </a>
                        <a class="flex items-center mt-4 py-2 px-10 hover:bg-gray-700 hover:bg-opacity-50 hover:text-gray-100
                            {{request()->is('protocol/create/outgoing')? 'bg-gray-600 text-white' : ''}}"
                           href="{{route('protocol.create',['type' => 'outgoing'])}}">
                            <span><i class="fas fa-file-export"></i></span>
                            <span class="mx-3">{{__('app.outgoing')}}</span>
                        </a>
                    </div>
                </li>
                <li>
                    <a class="flex items-center mt-4 py-2 px-4 hover:bg-gray-700 hover:bg-opacity-50 hover:text-gray-100
                        {{request()->is('records')? 'bg-gray-600 text-white' : ''}}"
                       href="{{route('records.index')}}">
                        <span><i class="fas fa-th-list"></i></span>
                        <span class="mx-3">{{__('app.records')}}</span>
                    </a>
                </li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{route('logout')}}"
                           class="flex items-center mt-4 py-2 px-4 hover:bg-gray-700 hover:bg-opacity-50 hover:text-gray-100"
                           onclick="event.preventDefault(); this.closest('form').submit();">
                            <span><i class="fas fa-power-off"></i></span>
                            <span class="mx-3">{{__('app.logout')}}</span>
                        </a>
                    </form>
                </li>
            </ul>
        </nav>
    </div>
</div>
