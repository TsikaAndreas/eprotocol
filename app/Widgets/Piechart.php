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
        return '<div class="widget-header bg-indigo-600 text-white p-3 rounded-t-lg" style="text-align-last: justify">
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
        $data['total'] = Protocol::count();
        $data['incoming'] = Protocol::incoming()->count();
        $data['outgoing'] = Protocol::outgoing()->count();
        $data['active'] = Protocol::active()->count();
        $data['canceled'] = Protocol::canceled()->count();
        $this->config = array_merge($this->config, ['data' => $data]);

        return view('widgets.piechart', [
            'config' => $this->config,
        ]);
    }
}
