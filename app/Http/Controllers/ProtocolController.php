<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProtocolRequest;
use App\Models\Protocol;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
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
        $title = ($type == 'incoming') ? 'Νέο Εισερχόμενο' : (($type == 'outgoing') ? 'Νέο Εξερχόμενο' : abort(404));

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
        //get validated fields & assign them
        $data = $request->validated();

        $max_protocol_number = Protocol::max('protocol_number') + 1;

        if(Protocol::where('protocol_number',$max_protocol_number)->first() !== null){
            return ['message' => 'This protocol number already exists. Please try again!'];
        }

        //save protocol
        $protocol = new Protocol();
        $protocol->protocol_number = $max_protocol_number;
        $protocol->protocol_date = $data['protocol_date'];
        if ($data['type'] == 'incoming') {
            $protocol->protocol = 'ΓΑΒ-ΕΙΣ-'.$protocol->protocol_number.'/'.$data['protocol_date'];
            $protocol->incoming_protocol = $data['incoming_protocol'];
            $protocol->incoming_protocol_date = $data['incoming_protocol_date'];
        }elseif ($data['type'] == 'outgoing') {
            $protocol->protocol = 'ΓΑΒ-ΕΞ-'.$protocol->protocol_number.'/'.$data['protocol_date'];
        }
        $protocol->status = 'Active';
        $protocol->creator = $data['creator'];
        $protocol->receiver = $data['receiver'];
        $protocol->title = $data['title'];
        $protocol->description = $data['description'];
        $protocol->save();

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
