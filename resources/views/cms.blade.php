@extends('layouts.front')
@section('title')
    {{ucwords($cms->name)}}
@endsection
<style>
    body {
        background-size: cover !important;
    }
    .cms{
        padding:3%;
    }
</style>
@section('content')
    <section class="second_sec">
        <div class="">
                <div class="row cms">
                        {!! $cms->value !!}
            </div>
        </div>
    </section>
@endsection