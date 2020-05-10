@extends('layouts.app')

@section('content')
    <div class="container">
        @csrf
        <div class="row">
            <h1>Edit {{ $lab->name }}</h1>
        </div>
        <div class="row">
            <div class=".col-2.offset-2">

                {{ Form::model($lab, array('route' => array('labs.update', $lab->id), 'method' => 'Patch')) }}
                @csrf

                <div class="form-group">
                    {{ Form::label('name', 'Name') }}
                    {{ Form::text('name', null, array('class' => 'form-control')) }}
                </div>

                <div class="form-group">
                    {{ Form::label('location', 'Location') }}
                    {{ Form::text('location', null, array('class' => 'form-control')) }}
                </div>

                <div class="form-group">
                    {{ Form::label('latitude', 'Latitude') }}
                    {{ Form::text('latitude', null, array('class' => 'form-control')) }}
                </div>

                <div class="form-group">
                    {{ Form::label('longitude', 'Longitude') }}
                    {{ Form::text('longitude', null, array('class' => 'form-control')) }}
                </div>

                {{ Form::submit('Edit Lab', array('class' => 'btn btn-primary')) }}

                {{ Form::close() }}

            </div>
        </div>
    </div>
    </form>







@endsection
