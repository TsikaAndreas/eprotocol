<?php

namespace App\Http\Controllers;

class RecordsController extends Controller
{
    public function index(){
        return view('records')->with(['title' => 'Εγγραφές']);
    }

    public function getRecords(){

    }
}
