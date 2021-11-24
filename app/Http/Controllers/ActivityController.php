<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Lang;
use Spatie\Activitylog\Models\Activity;
use Yajra\DataTables\DataTables;

class ActivityController extends Controller
{
    static array $action_type = [
        'auth-login' => 'success',
        'auth-logout' => 'success',
        'auth-failed' => 'warning',
        'create' => 'success',
        'edit' => 'success',
        'add-files' => 'primary',
        'delete-file' => 'danger',
        'protocol-reactivate' => 'warning',
        'protocol-cancel' => 'warning',
        'user-update' => 'primary',
        'password-update' => 'warning',
        'successful-backup' => 'success',
        'failed-backup' => 'warning',
        'successful-cleanup' => 'success',
        'failed-cleanup' => 'warning'
    ];
    /**
     * Function that returns the columns for the datatable.
     *
     * @return array
     */
    private function columns(): array
    {
        return [
            ['data' => 'created_at', 'name' => 'created_at', 'title' => __('dataTable.created_at'), 'responsivePriority' => 1],
            ['data' => 'log_name', 'name' => 'log_name', 'title' => __('dataTable.log_name'), 'responsivePriority' => 2],
            ['data' => 'description', 'name' => 'description', 'title' => __('dataTable.description'),
                'responsivePriority' => 3, 'orderable' => false],
            ['data' => 'causer_type', 'name' => 'causer_type', 'title' => __('dataTable.causer_type'), 'responsivePriority' => 4],
            ['data' => 'causer_id', 'name' => 'causer_id', 'title' => __('dataTable.causer_id'), 'responsivePriority' => 5],
            ['data' => 'subject_type', 'name' => 'subject_type', 'title' => __('dataTable.subject_type'), 'responsivePriority' => 6],
            ['data' => 'subject_id', 'name' => 'subject_id', 'title' => __('dataTable.subject_id'), 'responsivePriority' => 7],
            ['data' => 'properties', 'name' => 'properties', 'title' => __('dataTable.properties'),
                'responsivePriority' => 8, 'orderable' => false]
        ];
    }

    public function index()
    {
        $langFile = file_get_contents(resource_path('dataTables/lang/'.Config::get('languages')[Lang::getLocale()].'.json'));
        return view('activity_log')->with([
            'title' => 'app.activity_log',
            'columns' => $this->columns(),
            'lang_file' => $langFile,
            'url' => route('activity.getData')
        ]);
    }

    /**
     * Function that populates the datatable.
     *
     * @return mixed
     * @throws \Throwable
     */
    public function tableData()
    {
        return DataTables::of(Activity::query())
//            //added order by latest
            ->order(function ($query) {
                $query->orderBy('created_at', 'DESC');
            })
//            //edit dates
            ->editColumn('created_at', function ($activity) {
                return date('d-m-Y H:i:s', strtotime($activity->created_at) );
            })
            ->editColumn('updated_at', function ($activity) {
                return date('d-m-Y H:i:s', strtotime($activity->updated_at) );
            })
            ->editColumn('log_name', function ($activity) {
                return '<div class="mx-auto badge-'.self::$action_type[$activity->log_name].'">'.$activity->log_name.'</div>';
            })
            ->editColumn('properties', function ($activity) {
                $html = '';
                foreach ($activity->properties as $key => $property){
                    $html .= '<p>'.$key.': '.$property.'</p>';
                }
                return $html;
            })
//            //add row tailwind css styling
            ->rawColumns(['log_name','properties'])
            ->setRowClass('text-center')
            ->make(true);
    }
}
