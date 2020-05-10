@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3">

        </div>
        <div class="col-9">
            <div class="d-flex justify-content-between">
            <div><h1> Hi {{Auth::user()->name}}!</h1></div>
            <a href="/p/create">Add New Lab</a>
            </div>
        </div>

    </div>
</div>
@endsection
