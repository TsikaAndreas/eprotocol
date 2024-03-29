<?php

namespace App\Widgets;

use App\Models\Protocol;
use Arrilot\Widgets\AbstractWidget;

class LatestProtocols extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [
        'title' => 'dashboard.latest_protocols_title',
        'data' => ''
    ];

// Reload widget every 60 seconds
//    public $reloadTimeout = 60;

    public function container()
    {
        return [
            'element'       => 'div',
            'attributes'    => 'class="bg-white rounded-lg shadow-xl overflow-hidden" style="height: 24rem;"',
        ];
    }

    public function placeholder()
    {
        return '<div class="widget-header bg-indigo-600 text-white p-2 rounded-t-lg">
                    <i class="fas fa-server"></i>
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
        $protocols = Protocol::orderBy('updated_at','desc')->limit(10)->get()->each(function ($protocol) {
            $protocol->status = '<span class="badge-'.Protocol::$protocol_status[$protocol->status].'">'.
                __('dashboard.latest_protocols_'.strtolower($protocol->status)).'</span>';
            return $protocol;
        });

        $this->config = array_merge($this->config, ['data' => $protocols]);

        return view('widgets.latest_protocols', [
            'config' => $this->config,
        ]);
    }
}
