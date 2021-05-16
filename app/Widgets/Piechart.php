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
        'title' => 'Protocols PieChart',
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
        return '<div class="h-full w-full"><img class="mx-auto" src="'. asset('assets/gifs/loading.gif') .'" alt="This is a loader." /></div>';
    }

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $protocols['Total'] = Protocol::all()->count();
        $protocols['Ingoing'] = Protocol::where('type','=',Protocol::INGOING)->get()->count();
        $protocols['Outgoing'] = Protocol::where('type','=',Protocol::OUTGOING)->get()->count();
        $protocols['Active'] = Protocol::where('status','=',Protocol::ACTIVE)->get()->count();
        $protocols['Canceled'] = Protocol::where('status','=',Protocol::CANCELED)->get()->count();
        $this->config = array_merge($this->config, ['data' => $protocols]);

        return view('widgets.piechart', [
            'config' => $this->config,
        ]);
    }
}
