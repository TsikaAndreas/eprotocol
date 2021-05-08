<?php

namespace App\Http\Controllers;

use App\Models\Protocol;
use Yajra\DataTables\DataTables;

class RecordsController extends Controller
{
    public function index()
    {
        return view('records')->with(['title' => 'Εγγραφές']);
    }

    public function getRecords()
    {
        $protocols = Protocol::query();
        return DataTables::of($protocols)
            //added order by latest modified protocol
            ->order(function ($query) {
                $query->orderBy('updated_at', 'desc');
            })
            //edit dates
            ->editColumn('created_at', function ($protocols)
            {
                return date('d-m-Y H:i:s', strtotime($protocols->created_at) );
            })
            ->editColumn('updated_at', function ($protocols)
            {
                return date('d-m-Y H:i:s', strtotime($protocols->updated_at) );
            })->editColumn('canceled_at', function ($protocols)
            {
                if ($protocols->canceled_at !== null) {
                    return date('d-m-Y H:i:s', strtotime($protocols->canceled_at));
                }
            })
            // add action button
            ->addColumn('action', function (Protocol $protocol) {
                return '<a href="'.route('protocol.show',['id'=>$protocol]).'">'.'<i class="text-indigo-600 fas fa-search"></i>'.'</a>';
            })
            //add row tailwind css styling
            ->setRowClass('text-center')
            ->make(true);
    }
}
