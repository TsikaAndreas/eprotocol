<?php

namespace App\Http\Controllers;

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
}
