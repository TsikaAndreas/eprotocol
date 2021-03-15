<?php

namespace App\Http\Controllers;

class GeneralController extends Controller
{
    public function slashRedirect()
    {
        if (!auth()->user()) {
            return view('auth.login');
        }
        return redirect('/dashboard');
    }
}
