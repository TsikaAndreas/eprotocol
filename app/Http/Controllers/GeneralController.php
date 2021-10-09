<?php

namespace App\Http\Controllers;

use App\Models\Protocol;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;

class GeneralController extends Controller
{
    public function slashRedirect()
    {
        if (!auth()->user()) {
            return Redirect::route('login');
        }
        return Redirect::route('dashboard');
    }

    public function globalSearch(Request $request)
    {
        $keyword = trim($request->keyword);

        $query = Protocol::query();
        $query->select('id', 'protocol', 'incoming_protocol', 'creator', 'receiver', 'created_at');

        $query->where('protocol', 'like', '%'. $keyword . '%');
        $query->orWhere('incoming_protocol', 'like', '%'. $keyword . '%');
        $query->orWhere('creator', 'like', '%'. $keyword . '%');
        $query->orWhere('receiver', 'like', '%'. $keyword . '%');
        $query->orWhere('created_at', 'like', '%'. $keyword . '%');

        $total = $query->count();
        $result = $query->limit(10)->get();
        return response()->json([ 'total' => $total, 'data' => $result], 200);
    }
}
