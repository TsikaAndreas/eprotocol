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
        $title = ($type == 'incoming') ? 'Νέο Εισερχόμενο' : (($type == 'outgoing') ? 'Νέο Εξερχόμενο' : abort(404));

        return view('protocol')->with(['title' => $title,'type' => $type]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProtocolRequest $request
     * @return void
     */
    public function store(ProtocolRequest $request)
    {
        dd($request);
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
