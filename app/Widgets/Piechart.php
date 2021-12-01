<?php

namespace App\Widgets;

use App\Models\Protocol;
use Arrilot\Widgets\AbstractWidget;

class Piechart extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [
        'title' => 'dashboard.piechart_title',
        'data' => ''
    ];

    public function container()
    {
        return [
            'element'       => 'div',
            'attributes'    => 'class="bg-white rounded-lg shadow-xl h-96 overflow-hidden"',
        ];
    }

    public function placeholder()
    {
        return '<div class="widget-header bg-indigo-600 text-white p-2 rounded-t-lg">
                    <i class="fas fa-chart-pie"></i>
                    <h3 class="p-1 inline-block">'.__($this->config["title"]).'</h3>
                </div>
                <div class="h-full w-full mt-10">
                    <img class="mx-auto" src="'. asset('assets/gifs/loading.gif') .'" alt="This is a loader." />
                </div>';
    }

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $data = [
            'total' => Protocol::count(),
            'types' => [
                'Incoming' => [
                    'value' => Protocol::incoming()->count(),
                    'color' => 'rgb(248, 113, 113)', //'bg-red-400'
                ],
                'Outgoing' => [
                    'value' => Protocol::outgoing()->count(),
                    'color' => 'rgb(96, 165, 250)', //'bg-blue-400'
                ],
                'Active' => [
                    'value' => Protocol::active()->count(),
                    'color' => 'rgb(251, 191, 36)', //'bg-yellow-400'
                ],
                'Canceled' => [
                    'value' => Protocol::canceled()->count(),
                    'color' => 'rgb(52, 211, 153)', //'bg-green-400'
                ]
            ],
        ];
        foreach ($data['types'] as $key => $item){
            $data['types'][$key]['percentage'] = number_format($item['value'] / $data['total'] * 100,2);
        }

        return view('widgets.piechart', [
            'config' => $this->config,
            'data' => $data
        ]);
    }
}
