<div class="widget-header bg-indigo-600 text-white p-2 rounded-t-lg">
    <i class="fas fa-user-clock"></i>
    <h3 class="p-1 inline-block">{{__($config['title'])}}</h3>
</div>

<div class="h-5/6 overflow-auto bg-white rounded-b-lg">
    @if(sizeof($config['data']) > 0 )
        <table class="min-w-full table-auto divide-y divide-gray-700">
            <thead class="bg-white text-custom-indigo text-center text-xs font-medium tracking-wider uppercase pb-1">
                <tr>
                    <th scope="col" class="px-6 py-3">{{__('dashboard.latest_activity_name')}}</th>
                    <th scope="col" class="px-6 py-3">{{__('dashboard.latest_activity_description')}}</th>
                    <th scope="col" class="px-6 py-3">{{__('dashboard.latest_activity_type')}}</th>
                    <th scope="col" class="px-6 py-3">{{__('dashboard.latest_activity_ip')}}</th>
                    <th scope="col" class="px-6 py-3">{{__('dashboard.latest_activity_time')}}</th>
                </tr>
            </thead>
            <tbody class="text-center text-sm">
            @foreach($config['data'] as $index => $record)
                <tr class="border-custom-indigo border-dashed odd:bg-white even:bg-gray-200">
                    <td class="p-2"><i class="fas fa-genderless mr-5 text-custom-indigo"></i>{{$record['name']}}</td>
                    <td class="p-2">{{$record['description']}}</td>
                    <td class="p-2 whitespace-nowrap">{!! $record['status'] !!}</td>
                    <td class="p-2">{{$record['ip']}}</td>
                    <td class="p-2">{{$record['time']}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <div class="p-5 text-gray-500">
            {{__('dashboard.latest_activity_no_found')}}
        </div>
    @endif
</div>
