<div class="sidebar">
    <div class="shadow_bg"></div>
    <div class="inner_sidebar">
        <div class="close">
            <i class="fas fa-times"></i>
        </div>
        <div class="logo">
            <a href="{{route('dashboard')}}" class="text-white text-2xl mx-2 font-semibold">
                {{__('app.eProtocol')}}
            </a>
        </div>
        <ul class="sidebar_nav_links">
            <li><a href="{{route('dashboard')}}" class="{{request()->is('dashboard')? 'active' : ''}}">
                <span class="icon">
                    <i class="fas fa-tachometer-alt"></i>
                </span>
                    <span class="title">{{__('app.dashboard')}}</span>
                </a></li>
            <li x-data="{selected:{{request()->is('protocol/create/*')? '0' : 'null' }}}">
                <a href="#" @click="selected !== 0 ? selected = 0 : selected = null">
                <span class="icon">
                    <i class="fas fa-file-alt"></i>
                </span>
                    <span class="title">{{__("app.protocol")}}</span>
                </a>
                <div x-show="selected == 0">
                    <a href="{{route('protocol.create',['type' => 'incoming'])}}"
                       class="{{request()->is('protocol/create/incoming')? 'active' : ''}}">
                    <span class="icon">
                        <i class="fas fa-file-import"></i>
                    </span>
                        <span class="title">{{__("app.incoming")}}</span>
                    </a>
                    <a href="{{route('protocol.create',['type' => 'outgoing'])}}"
                       class="{{request()->is('protocol/create/outgoing')? 'active' : ''}}">
                    <span class="icon">
                        <i class="fas fa-file-export"></i>
                    </span>
                        <span class="title">{{__("app.outgoing")}}</span>
                    </a>
                </div>
            </li>
            <li>
                <a href="{{route('records.index')}}" class="{{request()->is('records')? 'active' : ''}}">
                <span class="icon">
                    <i class="fas fa-th-list"></i>
                </span>
                    <span class="title">{{__("app.records")}}</span>
                </a></li>
            <li>
            <li>
                <a href="{{route('activity.index')}}" class="{{request()->is('activity')? 'active' : ''}}">
                <span class="icon">
                    <i class="fas fa-database"></i>
                </span>
                    <span class="title">{{__("app.activity_log")}}</span>
                </a></li>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{route('logout')}}" onclick="event.preventDefault(); this.closest('form').submit();">
                    <span class="icon">
                        <i class="fas fa-power-off"></i>
                    </span>
                        <span class="title">{{__("app.logout")}}</span>
                    </a>
                </form>
            </li>
        </ul>
    </div>
</div>
