<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProtocolRequest;
use App\Models\Protocol;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
        $title = ($type == 'ingoing') ? 'Νέο Εισερχόμενο' : (($type == 'outgoing') ? 'Νέο Εξερχόμενο' : abort(404));

        return view('protocol')->with(['title' => $title,'type' => $type]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProtocolRequest $request
     * @return string[]
     */
    public function store(ProtocolRequest $request)
    {
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
        }
        $protocol->protocol = 'ΓΑΒ-ΕΙΣ-'.$protocol->id.'/'.$protocol->protocol_date;
        $protocol->update();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param Protocol $protocol
     * @return void
     */
    public function show(Protocol $protocol)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Protocol $protocol
     * @return void
     */
    public function edit(Protocol $protocol)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Protocol $protocol
     * @return void
     */
    public function update(Request $request, Protocol $protocol)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Protocol $protocol
     * @return void
     */
    public function destroy(Protocol $protocol)
    {
        //
    }
}
