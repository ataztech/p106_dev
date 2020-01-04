@extends('layouts.app-dashboard')

<title>What do you want to prepare for?</title>
@section('content')
<style>
    label{
    font-size: 35px;
    height: 82px;
    padding-top: 30px!important; 
    }
    </style>
<div class="right_sec width_100">
  <div class="container">
    <h2>What do you want to prepare for?</h2>
      <form class="form_check" action="{{url('user/configure/save-prepare')}}" id="form-prepare">
        <div class="inputGroup">
          <input id="option1" name="board_exam" type="checkbox"/>
          <label for="option1">Board Exams</label>
        </div>
        
        <div class="inputGroup">
          <input id="option2" name="competitive_exam" type="checkbox"/>
          <label for="option2">Competitive Exams</label>
        </div>
 
      </form>
    </div>
</div>
<footer class="footer" id="Footer_Main">
  <div class="container">
      <div class="foot_inner">      
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-6 text-left">
                <a href="{{url('user/configure/class')}}" class="pre_next"><i class="fa fa-chevron-left"></i> Previous</a>
            </div>
              <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                <a href="javascript:void(0)" onclick="$('#form-prepare').submit()" class="pre_next"> Next <i class="fa fa-chevron-right"></i></a>
            </div>
        </div>
      </div>
  </div> 
</footer>

@endsection



