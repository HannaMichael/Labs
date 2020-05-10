<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MapController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $labs = \App\Lab::All();
        return view('/map',compact('labs'));
    }

    //
}
