@extends('layouts.app-dashboard')
<title>Select Your Class</title>
@section('content')

<div class="right_sec width_100">
  <div class="container">
      <h2>Select Your Class</h2>
       <!--<p class="descritn">Lorem Ipsum has been the industry's standard dummy text ever <br/>since the 1500s</p>-->
      <div class="which_class">
          <div class="row">
              <div class="col-md-6 col-sm-6 col-xs-6">
                 <a href="{{url('user/configure/save-class/11th')}}" class="class_inner colr1">
                  <i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
                    <span>11<sup>th</sup></span>
                 </a>
              </div>
              <div class="col-md-6 col-sm-6 col-xs-6">
                 <a href="{{url('user/configure/save-class/12th')}}"  class="class_inner colr2">
                    <i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
                    <span>12<sup>th</sup></span>
                 </a>
              </div>
          </div>
      </div>
  </div>
</div>
<!--<footer class="footer" id="Footer_Main">
  <div class="container">
      <div class="foot_inner">      
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-6 text-left">
                <a href="#" class="pre_next"><i class="fa fa-chevron-left"></i> Previous</a>
            </div>
              <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                <a href="#" class="pre_next"> Next <i class="fa fa-chevron-right"></i></a>
            </div>
        </div>
      </div>
  </div> 
</footer>-->

@endsection



