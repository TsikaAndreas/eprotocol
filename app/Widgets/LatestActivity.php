<?php

namespace App\Widgets;

use App\Http\Controllers\ActivityController;
use Arrilot\Widgets\AbstractWidget;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Activity;

class LatestActivity extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [
        'title' => 'dashboard.latest_activity_title',
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
        return '<div class="widget-header bg-indigo-600 text-white p-3 rounded-t-lg">
                    <i class="fas fa-user-clock"></i>
                    <h3 class="p-1 inline-block">'.__($this->config["title"]).'</h3>
                </div>
                <div class="h-5/6 w-full bg-white rounded-b-lg pt-5">
                    <img class="mx-auto" src="'. asset('assets/gifs/loading.gif') .'" alt="This is a loader." />
                </div>';
    }

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $activities = Activity::with('causer')->whereIn('log_name', ['auth-login', 'auth-logout', 'auth-failed'])
            ->where('causer_id', Auth::user()->getAuthIdentifier())
            ->orderBy('created_at', 'desc')->limit(10)->get();

        $data = array();
        $index = 0;
        foreach ($activities as $activity) {
            $data[$index]['name'] = $activity->causer->lastname.' '.$activity->causer->firstname;
            $data[$index]['description'] = $activity->description;
            $data[$index]['status'] = '<span class="mx-auto badge-'.ActivityController::$action_type[$activity->log_name].'">'.$activity->log_name.'</span>';
            $data[$index]['ip'] = $activity->properties['ip'];
            $data[$index]['time'] = $activity->created_at->diffForHumans();
            $index++;
        }
        $this->config = array_merge($this->config, ['data' => $data]);

        return view('widgets.latest_activity', [
            'config' => $this->config,
        ]);
    }
}
