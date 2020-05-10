<?php

namespace App\Http\Controllers;

use App\Lab;
use phpDocumentor\Reflection\Types\AbstractList;
use Illuminate\Support\Facades\Validator;
use Request;
use Session;

use Illuminate\Support\Facades\Input as input;

class LabsController extends Controller
{

    public function index(){
        $labs = \App\Lab::All();
        return view('labs.index',compact('labs'));
    }
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(){
        return view('labs.create');
    }

    public function store(){

        $data = request()->validate([
            'name'=>'required',
            'location'=>'required',
            'latitude'      => '',
            'longitude'      => '',


        ]);

        auth()->user()->labs()->create($data);
        return redirect('/');

    }

    public function destroy($id){


        $lab = Lab::findOrFail($id);

        $lab->delete();

        return redirect('/');

    }

    public function edit($id)
    {
        // get the nerd
        $lab = Lab::find($id);

        // show the edit form and pass the nerd
        return View('labs.edit')
            ->with('lab', $lab);
    }


    public function update($id)
    {
        $rules = array(
            'name'       => 'required',
            'location'      => 'required',
        );

        $validator = Validator::make(Request::all(), $rules);



        // process the login
        if ($validator->fails()) {
            return Redirect::to('labs/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput(Request::except('password'));
        } else {
            // store


            $lab = Lab::find($id);
            $lab->name       = Request::get('name');
            $lab->location      = Request::get('location');
            $lab->save();

            // redirect
            Session::flash('message', 'Successfully updated nerd!');
            return redirect('/');
        }
    }

}
