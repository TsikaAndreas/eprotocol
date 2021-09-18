<?php

namespace App\Http\Controllers;

use App\Models\Protocol;
use Exception;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Lang;
use Yajra\DataTables\DataTables;

class RecordsController extends Controller
{
    static array $protocol_status = [
        'Active' => 'active',
        'Canceled' => 'cancel'
    ];

    /**
     * Function that returns the columns for the datatable.
     *
     * @return array
     */
    private function columns(): array
    {
        return [
            ['data' => 'protocol', 'name' => 'protocol', 'title' => __('dataTable.protocol'), 'responsivePriority' => 1],
            ['data' => 'protocol_date', 'name' => 'protocol_date', 'title' => __('dataTable.protocol_date')],
            ['data' => 'type', 'name' => 'type', 'title' => __('dataTable.type')],
            ['data' => 'status', 'name' => 'status', 'title' => __('dataTable.status')],
            ['data' => 'creator', 'name' => 'creator', 'title' => __('dataTable.creator')],
            ['data' => 'receiver', 'name' => 'receiver', 'title' => __('dataTable.receiver')],
            ['data' => 'created_at', 'name' => 'created_at', 'title' => __('dataTable.created_at')],
            ['data' => 'updated_at', 'name' => 'updated_at', 'title' => __('dataTable.updated_at')],
            ['data' => 'canceled_at', 'name' => 'canceled_at', 'title' => __('dataTable.canceled_at')],
            ['data' => 'action', 'name' => 'action', 'title' => __('dataTable.action'),
                'responsivePriority' => 2, 'orderable' => false, 'searchable' => false, 'class' => 'no-export'
            ]
        ];
    }

    public function index()
    {
        $languageFile = file_get_contents(resource_path('dataTables/lang/'.Config::get('languages')[Lang::getLocale()].'.json'));
        return view('records')->with(['title' => 'app.records', 'columns' => $this->columns(), 'language_file' => $languageFile]);
    }

    /**
     * Function that populates the datatable.
     *
     * @return mixed
     * @throws Exception
     */
    public function tableData()
    {
        return DataTables::of(Protocol::query()->limit(1000))
            //added order by latest modified protocol
            ->order(function ($query) {
                $query->orderBy('updated_at', 'desc');
            })
            //edit dates
            ->editColumn('created_at', function ($protocol) {
                return date('d-m-Y H:i:s', strtotime($protocol->created_at) );
            })
            ->editColumn('updated_at', function ($protocol) {
                return date('d-m-Y H:i:s', strtotime($protocol->updated_at) );
            })
            ->editColumn('canceled_at', function ($protocol) {
                if ($protocol->canceled_at !== null) {
                    return date('d-m-Y H:i:s', strtotime($protocol->canceled_at));
                }
                return null;
            })
            ->editColumn('status', function ($protocol) {
                return '<div class="mx-auto badge-'.self::$protocol_status[$protocol->status].'">'.$protocol->status.'</div>';
            })
            // add action button
            ->addColumn('action', function ($protocol) {
                return '<a href="'.route('protocol.show',['id'=>$protocol]).'">'.'<i class="text-indigo-600 fas fa-search"></i>'.'</a>';
            })
            //add row tailwind css styling
            ->rawColumns(['status', 'action'])
            ->setRowClass('text-center')
            ->make(true);
    }
}
