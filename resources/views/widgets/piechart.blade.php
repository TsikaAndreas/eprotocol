<div class="widget-header bg-indigo-600 text-white p-2 rounded-t-lg">
    <i class="fas fa-chart-pie"></i>
    <h3 class="p-1 inline-block">{{__($config['title'])}}</h3>
</div>
<div class="w-full">
    <div class="chart-container w-full h-full overflow-auto input-block flex pt-5 px-3 grid row-cols-2">
        @if($data['total'] > 0)
            <div class="grid grid-cols-3">
                <div class="pie-chart-container max-w-max h-full col-span-2 place-self-center">
                    <canvas id="pie-chart"></canvas>
                </div>
                <div class="text-gray-500 text-sm">
                    <div class="grid grid-cols-4">
                        <i class="col-span-1 fas fa-genderless mr-5 text-custom-indigo self-center justify-self-end"></i>
                        <span class="col-span-3"><strong>{{__('dashboard.piechart_total')}}</strong>: {{$data['total']}}</span>
                    </div>
                    @foreach($data['types'] as $key => $item)
                        <div class="grid grid-cols-4 my-2">
                            <span class="col-span-1 inline-block w-6 h-1 mr-2 rounded-full self-center justify-self-end" style="background-color: {{$item['color']}};"></span>
                            <span class="col-span-3"><strong>{{$item['percentage']}}</strong>% {{__('dashboard.piechart_'.lcfirst($key))}}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <div class="p-5 text-gray-500">
                {{__('dashboard.no_protocols_found')}}
            </div>
        @endif
    </div>
</div>
@if($data['total'] > 0)
<script>
    new Chart( $('#pie-chart'), {
        type: 'doughnut',
        data: {
            labels: [
                @foreach($data['types'] as $key => $value)
                    '{{__('dashboard.piechart_'.lcfirst($key))}}',
                @endforeach
            ],
            datasets: [{
                data: [
                    @foreach($data['types'] as $key => $item)
                        '{{$item['value']}}',
                    @endforeach
                ],
                backgroundColor: [
                    @foreach($data['types'] as $key => $item)
                        '{{$item['color']}}',
                    @endforeach
                    // 'rgb(248, 113, 113)', //bg-red-400
                    // 'rgb(96, 165, 250)', //bg-blue-400
                    // 'rgb(251, 191, 36)', //bg-yellow-400
                    // 'rgb(52, 211, 153)', //bg-green-400
                    // 'rgb(167, 139, 250)'  //bg-purple-400
                ],
            }]
        },
        options: {
            plugins: {
                legend: {
                    display: false,
                }
            },
            animation: {
                animateRotate: true,
                animateScale: true,
            },
            responsive:true,
        },
    });
</script>
@endif
