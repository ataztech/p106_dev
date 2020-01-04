@extends('layouts.admin')
@section('title')
    Telecaller Dashboard
@endsection
@section('content')

    @php
    $demo_count = \App\Modules\Demo\Models\Demo::where('created_by_id',Auth::user()->id)->count();
    @endphp

    <div class="right_col" role="main">
        <!-- top tiles -->
        <div class="row tile_count">
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                    <div class="icon"><i class="glyphicon glyphicon-user"></i></div>
                    <div class="count">{{$demo_count}}</div>
                    <h3>Total Demos</h3>
                    {{--<p>Available.</p>--}}
                </div>
            </div>
            <!--style="background-image: url('../public/frontend/img/bg.jpg');"-->



        </div>
        <!-- /top tiles -->

        @php
            date_default_timezone_set('Asia/Kolkata'); // setting time zone
            $today_data = new \DateTime("now");
            $today_data = $today_data->format('d/m/Y');
            $today_demo_count = \App\Modules\Demo\Models\Demo::where('created_by_id',Auth::user()->id)->where('date',$today_data)->count();
        @endphp

        <div class="row tile_count">
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                    <div class="icon"></div>
                    <div class="count">{{$today_demo_count}}</div>
                    <h3>Total Today's Demos</h3>
                    {{--<p>Available.</p>--}}
                </div>
            </div>
            <!--style="background-image: url('../public/frontend/img/bg.jpg');"-->



        </div>


    </div>
@endsection

@section('footer')

@endsection