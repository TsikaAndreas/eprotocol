<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProtocolRequest;
use App\Models\Protocol;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;

class ProtocolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    /*public function index()
    {
        //
    }*/

    /**
     * Show the form for creating a new resource.
     *
     * @param $type
     * @return Application|Factory|View|Response
     */
    public function create($type)
    {
        $title = (new Protocol)->getProtocolTitle($type);

        return view('protocol')->with(['title' => $title,'type' => $type]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProtocolRequest $request
     * @return string
     */
    public function store(ProtocolRequest $request)
    {
        $rules = $request->rules();
        $validateResult = sanitize($request->validated(), $rules);//
        if ($validateResult !== true) {
            return $validateResult;
        }
        $data = $request->validated();

        $protocol = Protocol::create([
            'protocol_date' => $data['protocol_date'],
            'status' => 'Active',
            'type' => $data['type'],
            'creator' => $data['creator'],
            'receiver' => $data['receiver'],
            'title' => $data['title'],
            'description' => $data['description'],
            'protocol' => null
        ]);

        if ($protocol->type === 'ingoing'){
            $protocol->ingoing_protocol = $data['ingoing_protocol'];
            $protocol->ingoing_protocol_date = $data['ingoing_protocol_date'];
            $protocol->protocol = Protocol::in_prefix.$protocol->id.'/'.$protocol->protocol_date;
        } elseif($protocol->type === 'outgoing') {
            $protocol->protocol = Protocol::out_prefix.$protocol->id.'/'.$protocol->protocol_date;
        }

        $protocol->update();

        return Redirect::route('protocol.show',$protocol->id);
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return Application|Factory|View
     */
    public function show($id)
    {
        $protocol = Protocol::findOrFail($id);
        $title = (new Protocol)->getProtocolTitle($protocol->type);

        return view('protocol',['title'=>$title, 'protocol'=>$protocol, 'preview_mode'=>'PREVIEW']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return Application|Factory|View|RedirectResponse
     */
    public function edit($id)
    {
        $protocol = Protocol::findOrFail($id);
        $title = (new Protocol)->getProtocolTitle($protocol->type);

        return view('protocol',['title'=>$title, 'protocol'=>$protocol, 'preview_mode'=>'EDIT']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $id
     * @param ProtocolRequest $request
     * @return View|bool|RedirectResponse|Factory|Application|string
     */
    public function update($id,ProtocolRequest $request)
    {
        $rules = $request->rules();
        $validateResult = sanitize($request->validated(), $rules);//
        if ($validateResult !== true) {
            return $validateResult;
        }

        $data = $request->validated();
        $protocol = Protocol::find($id);
        $protocol->creator = $data['creator'];
        $protocol->receiver = $data['receiver'];
        $protocol->title = $data['title'];
        $protocol->description = $data['description'];
        $protocol->update();

        return Redirect::route('protocol.show',$protocol->id);
    }
}
