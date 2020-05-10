@extends('layouts.app')

@section('content')
<div class="container">
<form action="/p" enctype="multipart/form-data" method="post">
@csrf
    <div class="row">
        <h1>Add New Lab</h1>
    </div>
    <div class="row">
        <div class=".col-2.offset-2">
            <div class="form-group row">
                <label for="name" class="col-md-10 col-form-label ">Lab name</label>

                    <input id="name" type="text" class="form-control
                        @error('name') is-invalid @enderror"
                           name="name" value="{{ old('name') }}"
                           required autocomplete="name"
                           autofocus>

                    @error('name')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
            </div>

            <div class="row">

                <label for="location" class="col-md-10 col-form-label ">Location</label>

                <input type="text" class="form-control" id="location" name="location">

                @error('location')
                    <strong>{{ $message }}</strong>
                @enderror

            </div>

            <div class="row">

                <label for="latitude" class="col-md-10 col-form-label ">latitude</label>

                <input type="text" class="form-control" id="latitude" name="latitude">

                @error('latitude')
                <strong>{{ $message }}</strong>
                @enderror

            </div>

            <div class="row">

                <label for="longitude" class="col-md-10 col-form-label ">longitude</label>

                <input type="text" class="form-control" id="longitude" name="longitude">

                @error('longitude')
                <strong>{{ $message }}</strong>
                @enderror

            </div>



            {{--            <div class="row">--}}

{{--                <label for="image" class="col-md-10 col-form-label ">Post Image</label>--}}

{{--                <input type="file" class="form-control-file" id="image" name="image">--}}

{{--                @error('image')--}}
{{--                <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                @enderror--}}

{{--            </div>--}}


            <div class="row pt-4"  >
                <button class="btn btn-primary">Add Lab</button>
             </div>
        </div>
    </div>
</form>

@endsection
