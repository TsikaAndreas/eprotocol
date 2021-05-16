@if(sizeof($config['data']) > 0)
<div class="widget-header bg-indigo-600 text-white p-3 rounded-t-lg h-1/6" style="text-align-last: justify">
    <h3 class="p-1 inline-block">{{$config['title']}}</h3>
</div>

<div class="w-full">
    <div class="chart-container w-full h-full overflow-auto input-block">
        <div class="pie-chart-container w-1/2 h-1/2 mx-auto">
            <canvas id="pie-chart"></canvas>
        </div>
    </div>
</div>

<script>
    var ctx1 = $('#pie-chart');

    var mode = 'pie';

    var data1 = {
        labels: [
            @foreach($config['data'] as $key => $value)
                '{{$key}}',
            @endforeach
        ],
        datasets: [
            {
                label: "Protocols Summary",
                data: [
                    @foreach($config['data'] as $key => $value)
                        '{{$value}}',
                    @endforeach
                ],
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 205, 86)',
                    'rgb(37, 239, 155)',
                    'rgb(184, 23, 172)'
                ],
            }
        ]
    }

    var chart = new Chart( ctx1, {
        type: mode,
        data: data1,
        options: {
            animation: {
                animateRotate: true,
                animateScale: true,
            },
            responsive:true,
            title: {
                display: true,
                position: "top",
                text: '{{$config['title']}}',
                fontSize: 18,
                fontColor: "#111"
            },
            legend: {
                display: true,
                position: "bottom",
                labels: {
                    fontColor: "#333",
                    fontSize: 16
                }
            }
        },
    });
</script>
@endif
