<?php

namespace App\Http\Controllers;

use App\Models\Protocol;
use Illuminate\Support\Facades\Redirect;

class GeneralController extends Controller
{
    public function slashRedirect()
    {
        if (!auth()->user()) {
            return Redirect::route('login');
        }
        return Redirect::route('dashboard');
    }

    public function globalSearch($keyword)
    {
        $keyword = trim($keyword);

        $query = Protocol::query();
        $query->select('protocol', 'ingoing_protocol', 'creator', 'receiver', 'created_at', 'type');

        $query->where('protocol', 'like', '%'. $keyword . '%');
        $query->orWhere('ingoing_protocol', 'like', '%'. $keyword . '%');
        $query->orWhere('creator', 'like', '%'. $keyword . '%');
        $query->orWhere('receiver', 'like', '%'. $keyword . '%');
        $query->orWhere('created_at', 'like', '%'. $keyword . '%');
        $query->orWhere('type', 'like', '%'. $keyword . '%');

        $total = $query->count();
        $result = $query->limit(10)->get();
        return response()->json([ 'total' => $total, 'data' => $result], 200);
    }
}
