@if(sizeof($config['data']) > 0)

        <div class="widget-header bg-indigo-600 text-white p-3 rounded-t-lg">
            <h3 class="p-1">{{__($config['title'])}}</h3>
        </div>
        <div class="h-5/6 overflow-auto">
            @foreach($config['data'] as $record)
                <div class="border-2 border-indigo-600 rounded-xl my-2 mx-auto px-3 py-2 w-11/12">
                    <div class="inline-block mr-4 w-5/12">
                        <span class="block text-base">{{$record->protocol}}</span>
                        <span class="block text-xs">
                        <i class="text-gray-600 far fa-calendar-alt"></i>
                        {{$record->protocol_date}}
                    </span>
                    </div>
                    <div class="inline-block w-4/12">
                        <span class="block text-base">{{__('dashboard.latest_protocols_type')}}
                            <span class="capitalize text-indigo-600">
                                {{__('dashboard.latest_protocols_'.strtolower($record->type))}}
                            </span>
                        </span>
                        <span class="block text-sm">{{__('dashboard.latest_protocols_status')}}
                            <span class="capitalize text-indigo-600">
                                {{__('dashboard.latest_protocols_'.strtolower($record->status))}}
                            </span>
                        </span>
                    </div>
                    <div class="inline-block" style="vertical-align: 40%;">
                        <span class="block capitalize text-indigo-600">
                            <a href="{{route('protocol.show',['id' => $record->id])}}">
                                <i class="fas fa-search"></i> {{__('dashboard.latest_protocols_view')}}
                            </a>
                        </span>
                    </div>
                </div>
            @endforeach

        </div>
@endif
