@extends('layouts.app')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

@section('content')

    <head>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet"
              id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script type="text/javascript" src="{{URL::asset('js/GoogleMaps.js')}}"></script>

        <style>

            #map {
                height: 600px;
                width: 500px;
            }

            #left, #right {
                width: 48%;
                margin: 5px;
                padding: 1em;
                background: white;
            }

            #left {
                float: left;
            }

            #right {
                float: right;
            }

            section {
                padding-top: 4rem;
                padding-bottom: 5rem;
                background-color: #f1f4fa;
            }

            .wrap {
                display: flex;
                background: white;
                padding: 1rem 1rem 1rem 1rem;
                border-radius: 0.5rem;
                box-shadow: 7px 7px 30px -5px rgba(0, 0, 0, 0.1);
                margin-bottom: 2rem;
            }

            .wrap:hover {
                background: linear-gradient(135deg, #6394ff 0%, #0a193b 100%);
                color: #ffffff;
            }

            .mbr-section-title3 {
                text-align: left;
            }

            h2 {
                margin-top: 0.5rem;
                margin-bottom: 0.5rem;
            }

            .display-5 {
                font-family: 'Source Sans Pro', sans-serif;
                font-size: 1.4rem;
            }

            .mbr-bold {
                font-weight: 700;
            }

            p {
                padding-top: 0.5rem;
                padding-bottom: 0.5rem;
                line-height: 25px;
            }

            .display-6 {
                font-family: 'Source Sans Pro', sans-serif;
            }

            a.button3 {
                 display: inline-block;
                 padding: 0.3em 1.2em;
                 margin: 0 0.3em 0.3em 0;
                 border-radius: 2em;
                 box-sizing: border-box;
                 text-decoration: none;
                 font-family: 'Roboto', sans-serif;
                 font-weight: 300;
                 color: #FFFFFF;
                 background-color: #4eb5f1;
                 text-align: center;
                 transition: all 0.2s;
            }

            a.button3:hover {
                 background-color: #4095c6;
            }

            @media all and (max-width: 30em) {
                 a.button3 {
                      display: block;
                      margin: 0.2em auto;
                }
            }

        </style>
    </head>

    <div class="column" id="left">

        <div class="container " class="col-xs-1" align="center">
            <div class="row">
                <div class="col-9" ; style="margin: 15px">
                    <div align="left">
                        <div><h1> Hi {{Auth::user()->name}}!</h1></div>
                        <a href="/p/create">Add New Lab</a>

                    </div>
                </div>
            </div>


            <div style="width: 30rem; margin: 3px;border: 0;padding-left: 0;padding-bottom: 35px;padding-top: 50px"
                 align="left">
                <form class="form-inline my-2 my-lg-0" action="/search" method="POST">
                    @csrf
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search"
                           width="10px" name="searchInput">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>

                </form>
                @if(isset($details))
                    <p>The search results for <b> {{$query}} </b></p>

                @elseif(isset($message))
                    <p>{{$message}}</p>
                @endif


            </div>

            @foreach($labs as $lab)

                <div class="card" style="width: 30rem; margin: 3px;border: 0;padding-left: 0" align="left"
                     onclick="ShowMarker(document.getElementById({{$lab->id}}).value)">

                    <div class="column">
                        <div class="wrap">
                            <div class="text-wrap float-left">
                                <h2 class="mbr-fonts-style mbr-bold mbr-section-title3 display-5">
                                    <span align="left">{{$lab->name}}</span>
                                </h2>
                                <p id="location"
                                   class="mbr-fonts-style text1 mbr-text display-6"> {{$lab->location}}</p>
                                <p class="mbr-fonts-style text1 mbr-text display-6">
                                    {{ date('M d Y  H:i', strtotime($lab->created_at))}}
                                </p>

                                <a class="btn btn-small btn-info" href="{{ URL::to('labs/' . $lab->id . '/edit') }}">Edit</a>

                                {{ Form::open(array('url' => '/d/' . $lab->id, 'class' => 'pull-right')) }}
                                {{ Form::hidden('_method', 'DELETE') }}
                                {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                                {{ Form::close() }}

                                <input type="hidden" id="{{$lab->id}}" value="{{$lab->latitude}},{{$lab->longitude}}">
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>


    <div class="column" id="right" style="padding-top: 260px">
        <div id="map">
            <div class="column">
            </div>

            <script>

                <?php
                //  Geocoder::getCoordinatesForAddress('Samberstraat 69, Antwerpen, Belgium');
                ?>

                <?php
                //                $address = "   "; // Google HQ
                //                $prepAddr = str_replace(' ','+',$address);
                //                $geocode=file_get_contents('https://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=false');
                //                $output= json_decode($geocode);
                //                $latitude = $output->results[0]->geometry->location->lat;
                //                $longitude = $output->results[0]->geometry->location->lng;
                //                $latitude=55;
                //                $longitude=-90;

                ?>

                {{--var latitude = "<?php echo $latitude; ?>";--}}
                {{--var longitude = "<?php echo $longitude; ?>";--}}
                {{--ShowMarkerByAddress(latitude,longitude)--}}


            </script>


            <script src="https://maps.googleapis.com/maps/api/js?callback=initMap&libraries=places d"
                    async defer></script>

            <script>
                var startProductBarPos = -1;
                window.onscroll = function () {
                    var bar = document.getElementById('map');
                    if (startProductBarPos < 0) startProductBarPos = findPosY(bar);

                    if (pageYOffset > startProductBarPos) {
                        bar.style.position = 'fixed';
                        bar.style.top = 0;

                    } else {
                        bar.style.position = 'relative';
                    }
                };

                function findPosY(obj) {
                    var curtop = 0;
                    if (typeof (obj.offsetParent) != 'undefined' && obj.offsetParent) {
                        while (obj.offsetParent) {
                            curtop += obj.offsetTop;
                            obj = obj.offsetParent;
                        }
                        curtop += obj.offsetTop;
                    } else if (obj.y)
                        curtop += obj.y;
                    return curtop;
                }

            </script>


        </div>

    </div>








@endsection
