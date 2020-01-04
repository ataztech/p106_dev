@extends('layouts.app-dashboard')

@section('content')

<style>
    h4{
        margin-top:20px !important;
        font-weight: 900 !important;
        font-size: 25px !important;
    }
</style>
<div class="right_sec width_100">
<div class="container">
    <h2>Select Subjects</h2>
    
    
    {{dd(Auth::user()->configureSyllabus)}}
    <div class="exm_outr" style="margin-top:50px;">
    
         <form action='{{url('user/configure/save-subjects')}}' id="form-subjects" class="text-center">
       <div class="row">
          <div class="col-md-3 col-sm-3 col-xs-3">
              <a href="javascript:void(0)" class="media exm_clicked"  onclick="setSubject(this)">
             <i class="fa fa-check"></i>
              <div class="media-left"><img src="{{url('public/theme1/images/integrated-icon.png')}}"></div>
              <div class="media-body">
                <h4>Physics</h4>
                
                <input type="text" id="physics" name="physics" value="1">
              </div>
            </a>
          </div>
           <div class="col-md-3 col-sm-3 col-xs-3">
            <a href="javascript:void(0)" class="media" onclick="setSubject(this)">
             <i class="fa fa-check"></i>
              <div class="media-left"><img src="{{url('public/theme1/images/integrated-icon.png')}}"></div>
              <div class="media-body">
                <h4>Chemistry</h4>
                <input type="text" id="chemistry" name="chemistry" value="1">
              </div>
            </a>
          </div>
           <div class="col-md-3 col-sm-3 col-xs-3">
            <a href="javascript:void(0)" class="media" onclick="setSubject(this)">
             <i class="fa fa-check"></i>
              <div class="media-left"><img src="{{url('public/theme1/images/integrated-icon.png')}}"></div>
              <div class="media-body">
                <h4>Math</h4>
                <input type="text" id="math" name="math" value="1">
              </div>
            </a>
          </div>
          <div class="col-md-3 col-sm-3 col-xs-3">
            <a href="javascript:void(0)" class="media" onclick="setSubject(this)">
             <i class="fa fa-check"></i>
              <div class="media-left"><img src="{{url('public/theme1/images/integrated-icon.png')}}"></div>
              <div class="media-body">
                <h4>Biology</h4>
             <input type="text" id="biology" name="biology" value="1">
              </div>
            </a>
          </div>
       </div> 
         </form>
    </div>
  </div>
</div>
<footer class="footer" id="Footer_Main">
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
</footer>


<script>
   function setSubject(ele)
    {
        if($(ele).hasClass('exm_clicked'))
        {
            $(ele).removeClass('exm_clicked')
            $(ele).find("input").val(0)
        }else{
            $(ele).find("input").val(1)
            $(ele).addClass('exm_clicked')
        }
    }
    
  </script>  
@endsection



