<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProtocolRequest;
use App\Models\File;
use App\Models\Protocol;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;
use App\Services\FileManager;

class ProtocolController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @param $type
     * @return Application|Factory|View|Response
     */
    public function create($type)
    {
        $title = (new Protocol)->getProtocolType($type);

        return view('protocol')->with(['title' => $title,'type' => $type, 'preview_mode'=>'CREATE']);
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
        $validateResult = sanitize($request->validated(), $rules);
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

        if ($protocol->type === Protocol::INGOING){
            $protocol->ingoing_protocol = $data['ingoing_protocol'];
            $protocol->ingoing_protocol_date = $data['ingoing_protocol_date'];
            $protocol->protocol = Protocol::IN_PREFIX . $protocol->id . DIRECTORY_SEPARATOR . $protocol->protocol_date;
        } elseif($protocol->type === Protocol::OUTGOING) {
            $protocol->protocol = Protocol::OUT_PREFIX . $protocol->id . DIRECTORY_SEPARATOR . $protocol->protocol_date;
        }
        $protocol->update();
        if (isset($data['file'])) {
            $files = (new FileManager())->fileUpload($protocol->id, $data['file']);
            if (array_key_exists('error',$files)) {
                return \redirect()->back()->withInput()->withErrors($files);
            }
        }

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
        $title = (new Protocol)->getProtocolType($protocol->type);

        $files = File::getFiles($id);

        return view('protocol',['title'=>$title, 'protocol'=>$protocol, 'preview_mode'=>'PREVIEW','files' => $files]);
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
        $title = (new Protocol)->getProtocolType($protocol->type);
        $files = File::getFiles($id);

        return view('protocol',['title'=>$title, 'protocol'=>$protocol, 'preview_mode'=>'EDIT','files' => $files]);
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
        $validateResult = sanitize($request->validated(), $rules);
        if ($validateResult !== true) {
            return $validateResult;
        }

        $data = $request->validated();
        $protocol = Protocol::find($id);
        $protocol->creator = $data['creator'];
        $protocol->receiver = $data['receiver'];
        $protocol->title = $data['title'];
        $protocol->description = $data['description'];

        if ($protocol->type === Protocol::INGOING){
            $protocol->ingoing_protocol = $data['ingoing_protocol'];
            $protocol->ingoing_protocol_date = $data['ingoing_protocol_date'];
            $protocol->protocol = Protocol::IN_PREFIX . $protocol->id . DIRECTORY_SEPARATOR . $protocol->protocol_date;
        } elseif($protocol->type === Protocol::OUTGOING) {
            $protocol->protocol = Protocol::OUT_PREFIX . $protocol->id . DIRECTORY_SEPARATOR . $protocol->protocol_date;
        }

        $protocol->update();

        if (isset($data['file'])) {
            $files = (new FileManager())->fileUpload($protocol->id, $data['file']);
            if (array_key_exists('error',$files)) {
                return \redirect()->back()->withInput()->withErrors($files);
            }
        }
        return Redirect::route('protocol.show',$protocol->id);
    }
}
