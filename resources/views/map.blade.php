@extends('layouts.app')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="{{ asset('css/app.css') }}" rel="stylesheet">


@section('content')

    <head>
         <style>
                #map{
                    height: 100%;
                    width: 100%;
                }
        </style>
    </head>

    <div class="column" id="left">
        <div class="container " class="col-xs-1" align="center" >
            <div class="row">
                <div class="col-9"; style="margin: 15px"></div>
            </div>
        </div>
    </div>

    <div id="map" ></div>
        <script src="https://maps.googleapis.com/maps/api/js?callback=initMap&libraries=places d"
                    async defer></script>

        <script>
                function initMap() {
                    map = new google.maps.Map(document.getElementById('map'), {
                        center: {lat: 56, lng: -96},
                        zoom: 2
                    });
                    ShowMarker();
                }
                function ShowMarker() {
                    var latlng=[];
                    var marker;

                    @foreach($labs as $lab)
                        latlng.push(new google.maps.LatLng({{$lab->latitude}}, {{$lab->longitude}})) ;
                    @endforeach

                    for(var i=0; i<latlng.length;i++)
                    {
                        var Marker = new google.maps.Marker({
                                            position: latlng[i],
                                            map: map
                                        });
                    }
                }
        </script>
@endsection
