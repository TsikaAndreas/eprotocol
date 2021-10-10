<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProtocolRequest;
use App\Models\File;
use App\Models\Protocol;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;
use App\Services\FileManager;

class ProtocolController extends Controller
{
    const lang_prefix = 'protocol.header_';

    /**
     * Show the form for creating a new resource.
     *
     * @param $type
     * @return Application|Factory|View|Response
     */

    public function create($type)
    {
        $title = (new Protocol)->getProtocolType($type);

        return view('protocol')->with(['title' => self::lang_prefix.$title,'type' => $type, 'preview_mode'=>'CREATE']);
    }

    /**
     * Store a newly created resource.
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

        if ($protocol->type === Protocol::INCOMING){
            $protocol->incoming_protocol = $data['incoming_protocol'];
            $protocol->incoming_protocol_date = $data['incoming_protocol_date'];
            $protocol->protocol = Protocol::IN_PREFIX . $protocol->id . DIRECTORY_SEPARATOR . $protocol->protocol_date;
        } elseif($protocol->type === Protocol::OUTGOING) {
            $protocol->protocol = Protocol::OUT_PREFIX . $protocol->id . DIRECTORY_SEPARATOR . $protocol->protocol_date;
        }
        $protocol->update();

        // Activity Log
        activity('create')->causedBy(auth()->user()->getAuthIdentifier())
            ->performedOn($protocol)
            ->log(auth()->user()->getFullName() . ' created a new protocol: '. $protocol->protocol);

        if (isset($data['file'])) {
            $result = (new FileManager())->fileUpload($protocol, $data['file']);
            if (array_key_exists('error',$result)) {
                return \redirect()->back()->withInput()->withErrors($result['error']);
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
        $protocol->badge = '<span id="protocol_status" class="badge-'. Protocol::$protocol_status[$protocol->status]
            . '-lg">' . __('protocol.'.Protocol::$protocol_status[$protocol->status]) .'</span>';

        $title = (new Protocol)->getProtocolType($protocol->type);

        $files = File::getFiles($id);

        return view('protocol',['title'=> self::lang_prefix.$title, 'protocol'=>$protocol, 'preview_mode'=>'PREVIEW','files' => $files]);
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
        $protocol->badge = '<span id="protocol_status" class="badge-'. Protocol::$protocol_status[$protocol->status]
            . '-lg">' . __('protocol.'.Protocol::$protocol_status[$protocol->status]) .'</span>';

        $title = (new Protocol)->getProtocolType($protocol->type);
        $files = File::getFiles($id);

        return view('protocol',['title'=> self::lang_prefix.$title, 'protocol'=>$protocol, 'preview_mode'=>'EDIT','files' => $files]);
    }

    /**
     * Update the specified resource.
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

        if ($protocol->type === Protocol::INCOMING){
            $protocol->incoming_protocol = $data['incoming_protocol'];
            $protocol->incoming_protocol_date = $data['incoming_protocol_date'];
            $protocol->protocol = Protocol::IN_PREFIX . $protocol->id . DIRECTORY_SEPARATOR . $protocol->protocol_date;
        } elseif($protocol->type === Protocol::OUTGOING) {
            $protocol->protocol = Protocol::OUT_PREFIX . $protocol->id . DIRECTORY_SEPARATOR . $protocol->protocol_date;
        }

        $protocol->update();

        // Activity Log
        activity('edit')->causedBy(auth()->user()->getAuthIdentifier())
            ->performedOn($protocol)
            ->log(auth()->user()->getFullName() . ' edited the protocol: '. $protocol->protocol);

        if (isset($data['file'])) {
            $result = (new FileManager())->fileUpload($protocol, $data['file']);
            if (array_key_exists('error',$result)) {
                return \redirect()->back()->withInput()->withErrors($result['error']);
            }
        }
        return Redirect::route('protocol.show',$protocol->id);
    }

    /**
     * Function that change the status of the Protocol
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function changeStatus(Request $request) {
        $data = $request->only('id','action');
        $protocol = Protocol::find($data['id']);
        $action = $data['action'];

        if ($action === 'cancel') {
            if ($protocol->status === Protocol::CANCELED) {
                return response()->json(['error' => true, 'message' => __('message.already_canceled')]);
            }
            $protocol->status = Protocol::CANCELED;
            $protocol->canceled_at = date('Y-m-d H:i:s');
            $protocol->update();

            // Activity Log
            activity('protocol-cancel')->causedBy(auth()->user()->getAuthIdentifier())
                ->performedOn($protocol)
                ->log(auth()->user()->getFullName() . ' canceled the protocol: '. $protocol->protocol);

            return response()->json(['success' => true, 'message' => __('message.success_cancel')]);
        }
        if ($action === 'reactivate') {
            if ($protocol->status === Protocol::ACTIVE) {
                return response()->json(['error' => true, 'message' => __('message.already_reactivated')]);
            }
            $protocol->status = Protocol::ACTIVE;
            $protocol->update();

            // Activity Log
            activity('protocol-reactivate')->causedBy(auth()->user()->getAuthIdentifier())
                ->performedOn($protocol)
                ->log(auth()->user()->getFullName() . ' reactivated the protocol: '. $protocol->protocol);

            return response()->json(['success' => true, 'message' => __('message.success_reactivation')]);
        }
        return response()->json(['error' => true, 'message' => __('message.invalid_action')]);
    }
}
