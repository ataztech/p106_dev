@extends('layouts.app-dashboard')

<title>{{$exams->name}}</title>
@section('content')

<style>
    .paper_outer{
        width: 82%;
    }
    .afq_text_outer
    {
        background: #9575cd;
    width: 42%;
    /* margin: 6%; */
    position: relative;
    left: 29%;
    padding: 2%;
    color: #ffff;
    }
    

    .target-year{
        float: right;
    top: inline-block;
    position: relative;
    top: -30px;
    }    
    
    
    .paper_info ul li{
        color: #8e7a7a;
        font-size: 14px;
        
    }
    
    .afq_paper_outer{
        width: 100%;
    }
    
    .paper_info h5{
        font-size: 20px;
    }
    </style>



<div class="main_dash_right">
    <div class="motion_tab">
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"  ><a href="#home" onclick="$('#current-tab').text('Upcoming')" aria-controls="home" role="tab" data-toggle="tab" style="width:150px;">New + Upcoming</a></li>
        <li role="presentation"><a href="#profile" onclick="$('#current-tab').text('Missed')" aria-controls="profile" role="tab" data-toggle="tab">Missed</a></li>
        <li role="presentation"><a href="#settings" onclick="$('#current-tab').text('Attempted')" aria-controls="settings" role="tab" data-toggle="tab">Attempted</a></li>
        
        
      </ul>
        
        <div class="target-year">
            
            <select class="form-control" id="target-year">
                <option value="2018">2018</option>
                <option value="2019">2019</option>
                <option value="2020" selected="" >2020</option>
                <option value="2021">2021</option>
            </select>
        </div>
        
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="home"> 
                <div class="paper_outer afq_paper_outer">
                    <div class="paper_block">
                        <h3 class="h3_head">{{$exams->name}}</h3>
                        <p class="sub_para">
                            All-India tests to help you monitor your progress, and gauge how well prepared you are for D-day. Compete with students from all over the country and compare your scores to find out where you stand.</p>
                        
                        <h2>New Tests</h2>
                        <div class="row">

                            @foreach($todaysTestSeries as $test)
                            
                            
                            <div class="col-md-6 col-md-6 col-md-12 target-year-container tg-{{$test->target_year}}" >
                                <div class="paper_inr clearfix">
                                    <div class=" ">
                                        <i class="fa fa-calendar-o" aria-hidden="true"></i>
                                        <span>{{date('M', strtotime($test->start_date))}} {{date('d', strtotime($test->start_date))}} </span>

                                    </div>
                                    <div class="paper_info">
                                        <h5>{{$exams->name.' - '.$test->exam_type.' - '.$test->name}} </h5>
                                        <ul>
                                            <li>{{$test->total_question}} Questions</li>
                                            <li>{{$test->hour}}h {{$test->min}}m Time</li>
                                            <li>{{$test->mark}} Marks</li>
                                        </ul>
                                    </div>
                                    <div class="clearfix"></div>
                                    <a href="javascript:void(0)" onclick="showSyllabusModal({{$test->id}})">View Syllabus</a>
                                </div>
                            </div>
                            <div class="modal fade" id="syllabus_modal-{{$test->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            Syllabus<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        </div>
                                        <div class="modal-body clearfix" id="report-result"><div class="row">
                                                <div class="col-md-12">

                                                    <div class="text-center">
                                                        <div class="row">
                                                            <div style="margin-right: 14%;">
                                                                <i class="fa fa-calendar-o" aria-hidden="true"></i>
                                                                <span>{{date('M', strtotime($test->start_date))}} {{date('d', strtotime($test->start_date))}}</span>

                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="paper_info">
                                                                <h5>{{$exams->name.' - '.$test->exam_type.' - '.$test->name}}</h5>
                                                                <ul>
                                                                    <li>{{$test->total_question}} Questions</li>
                                                                    <li>{{$test->hour}}h {{$test->min}}m Time</li>
                                                                    <li>{{$test->mark}} Marks</li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="report_outr">
                                                        <div class="report_in">
                                                            <div class="row">

                                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                                    <!--@php
                                                                    $chapter_id_arr = [];
                                                                    @endphp-->
                                                                    
                                                                    <!--new code added by sohel-->
                                                                    @php
                                                                    $chapter_id_arr = [];
                                                                    $subject_name_arr = [];
                                                                    $sub_name_arr = [];

                                                                    foreach($test->testSeriesSubject as $key => $testSubject)
                                                                    {
                                                                        if(!in_array($testSubject->subject->name, $sub_name_arr))
                                                                        {
                                                                            $subject_name_arr[$key]['name'] = $testSubject->subject->name;
                                                                            $sub_name_arr[] = $testSubject->subject->name;
                                                                            foreach($test->testSeriesChapter as $index => $testChapter)
                                                                            {
                                                                                if($testChapter->chapter->subject->name == $testSubject->subject->name)
                                                                                {
                                                                                    if(!in_array($testChapter->chapter->id ,$chapter_id_arr))
                                                                                    {
                                                                                        $subject_name_arr[$key]['chapter'][$index] = $testChapter->chapter->name;
                                                                                        $chapter_id_arr[] = $testChapter->chapter->id;
                                                                                    }

                                                                                }
                                                                            }

                                                                        }
                                                                    }
                                                                    @endphp
                                                                    <!--@foreach($test->testSeriesSubject as $testSubject)
                                                                    <div class="media">
                                                                        <div class="media-left"><i class="fa fa-star" aria-hidden="true"></i></div>
                                                                        <div class="media-body">
                                                                            <h5>{{$testSubject->subject->name}}</h5>
                                                                            <ul class="disc-ul">
                                                                                @foreach($test->testSeriesChapter as $testChapter)
                                                                                @if($testChapter->chapter->subject_id == $testSubject->subject_id)
                                                                                @if(!in_array($testChapter->chapter->id ,$chapter_id_arr))
                                                                                <li class="disc-css">#{{$testChapter->chapter->name}}</li>
                                                                                @php
                                                                                $chapter_id_arr[] = $testChapter->chapter->id;
                                                                                @endphp
                                                                                @endif
                                                                                @endif
                                                                                @endforeach
                                                                            </ul>
                                                                        </div>
                                                                    </div>

                                                                    @endforeach-->
                                                                    
                                                                    <!--new code added by sohel-->
                                                                    @foreach($subject_name_arr as $subject)
                                                                        <div class="media">
                                                                            <div class="media-left"><i class="fa fa-star" aria-hidden="true"></i></div>
                                                                            <div class="media-body">
                                                                                <h5>{{$subject['name']}}</h5>
                                                                                <ul class="disc-ul">
                                                                                    @foreach($subject['chapter'] as $chapter)
                                                                                        <li class="disc-css">#{{$chapter}}</li>
                                                                                    @endforeach
                                                                                </ul>
                                                                            </div>
                                                                        </div>

                                                                    @endforeach


                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>




                                                </div>
                                            </div>
                                            <div style="padding-left:25%">
                                                <button class="btn_all next-btn" onclick="showInstructionsModal({{$test->id}})" style="width:300px">Read Instructions & Start Date</button>
                                                <!--<button class="skip_btn btn_all skip-btn" onclick="endSession()">End Session</button>-->

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="instruction_modal-{{$test->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            Instructions<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        </div>
                                        <div class="modal-body clearfix" id="report-result"><div class="row">
                                                <div class="col-md-12">

                                                    <div class="text-center">
                                                        <div class="row">
                                                            <div style="margin-right: 14%;">
                                                                <i class="fa fa-calendar-o" aria-hidden="true"></i>
                                                                <span>{{date('M', strtotime($test->start_date))}} {{date('d', strtotime($test->start_date))}}</span>

                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="paper_info">
                                                                <h5>{{$exams->name.' - '.$test->exam_type.' - '.$test->name}}</h5>
                                                                <ul>
                                                                    <li> {{$test->total_question}} Questions</li>
                                                                    <li> {{$test->hour}}h {{$test->min}}m Time</li>
                                                                    <li> {{$test->mark}} Marks</li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="report_outr">
                                                        <div class="report_in">
                                                            <div class="row">

                                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                                    
                                                                    <div class="media">
                                                                        <div class="media-left"><i class="fa fa-star" aria-hidden="true"></i></div>
                                                                        <div class="media-body">
                                                                            <h5>Points to remember</h5>
                                                                            <ul class="disc-ul">
                                                                                <li class="disc-css">#You wil get only <strong>one chance</strong> to attemp this test.</li>
                                                                                <li class="disc-css">#Make sure you have good internet connection.</li>
                                                                                <li class="disc-css">#Maximize your browser window before starting the test.</li>
                                                                                
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                    <h2>Best of Luck!</h2>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>




                                                </div>
                                            </div>
                                            <div style="padding-left:25%">
                                                <button class="btn_all next-btn" onclick="startTest({{$test->id}})" style="width:300px">Start Test</button>
                                                <!--<button class="skip_btn btn_all skip-btn" onclick="endSession()">End Session</button>-->

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            @endforeach
                            
                            @if(count($todaysTestSeries)==0)
                            <h4>No Tests Found.</h4>
                            @endif
                        </div>
                        <h2>Upcoming Tests</h2>
                        <div class="row">

                            @foreach($upcomingTestSeries as $test)
                            
                            
                            <div class="col-md-6 col-md-6 col-md-12 target-year-container tg-{{$test->target_year}}" >
                                <div class="paper_inr clearfix">
                                    <div class=" ">
                                        <i class="fa fa-calendar-o" aria-hidden="true"></i>
                                        <span>{{date('M', strtotime($test->start_date))}} {{date('d', strtotime($test->start_date))}} </span>

                                    </div>
                                    <div class="paper_info">
                                        <h5>{{$exams->name.' - '.$test->exam_type.' - '.$test->name}} </h5>
                                        <ul>
                                            <li>{{$test->total_question}} Questions</li>
                                            <li>{{$test->hour}}h {{$test->min}}m Time</li>
                                            <li> {{$test->mark}} Marks</li>
                                        </ul>
                                    </div>
                                    <div class="clearfix"></div>
                                    <a href="javascript:void(0)" onclick="showSyllabusModal({{$test->id}})">View Syllabus</a>
                                </div>
                            </div>
                            <div class="modal fade" id="syllabus_modal-{{$test->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            Syllabus<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        </div>
                                        <div class="modal-body clearfix" id="report-result">
                                            <div class="row">
                                                <div class="col-md-12">

                                                    <div class="text-center">
                                                        <div class="row">
                                                            <div style="margin-right: 14%;">
                                                                <i class="fa fa-calendar-o" aria-hidden="true"></i>
                                                                <span>{{date('M', strtotime($test->start_date))}} {{date('d', strtotime($test->start_date))}}</span>

                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="paper_info">
                                                                <h5>{{$exams->name.' - '.$test->exam_type.' - '.$test->name}}</h5>
                                                                <ul>
                                                                    <li>{{$test->total_question}} Questions</li>
                                                                    <li> {{$test->hour}}h {{$test->min}}m Time</li>
                                                                    <li>{{$test->mark}} Marks</li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="report_outr">
                                                        <div class="report_in">
                                                            <div class="row">

                                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                                    @php
                                                                    $chapter_id_arr = [];
                                                                    @endphp
                                                                    @foreach($test->testSeriesSubject as $testSubject)
                                                                    <div class="media">
                                                                        <div class="media-left"><i class="fa fa-star" aria-hidden="true"></i></div>
                                                                        <div class="media-body">
                                                                            <h5>{{$testSubject->subject->name}}</h5>
                                                                            <ul class="disc-ul">
                                                                                @foreach($test->testSeriesChapter as $testChapter)
                                                                                @if($testChapter->chapter->subject_id == $testSubject->subject_id)
                                                                                @if(!in_array($testChapter->chapter->id ,$chapter_id_arr))
                                                                                <li class="disc-css">#{{$testChapter->chapter->name}}</li>
                                                                                @php
                                                                                $chapter_id_arr[] = $testChapter->chapter->id;
                                                                                @endphp
                                                                                @endif
                                                                                @endif
                                                                                @endforeach
                                                                            </ul>
                                                                        </div>
                                                                    </div>

                                                                    @endforeach


                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>




                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @endforeach
                            @if(count($upcomingTestSeries)==0)
                                <h4>No Tests Found.</h4>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            
            <div role="tabpanel" class="tab-pane" id="profile">
                <div class="paper_outer">
                    <div class="paper_block">
                        <h3 class="h3_head">{{$exams->name}}</h3>
                        <p class="sub_para">
                            All-India tests to help you monitor your progress, and gauge how well prepared you are for D-day. Compete with students from all over the country and compare your scores to find out where you stand.</p>
                        
                        <h2>Missed Tests</h2>
                        <div class="row">

                            @foreach($missedTestSeries as $test)
                            
                            
                            <div class="col-md-6 col-md-6 col-md-12 target-year-container tg-{{$test->target_year}}" >
                                <div class="paper_inr clearfix">
                                    <div class=" ">
                                        <i class="fa fa-calendar-o" aria-hidden="true"></i>
                                        <span>{{date('M', strtotime($test->start_date))}} {{date('d', strtotime($test->start_date))}} </span>

                                    </div>
                                    <div class="paper_info">
                                        <h5>{{$exams->name.' - '.$test->exam_type.' - '.$test->name}} </h5>
                                        <ul>
                                            <li> {{$test->total_question}} Questions</li>
                                            <li>{{$test->hour}}h {{$test->min}}m Time</li>
                                            <li>{{$test->mark}} Marks</li>
                                        </ul>
                                    </div>
                                    <div class="clearfix"></div>
                                    <a href="javascript:void(0)" onclick="showSyllabusModal({{$test->id}})">View Syllabus</a>
                                </div>
                            </div>
                            <div class="modal fade" id="syllabus_modal-{{$test->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            Syllabus<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        </div>
                                        <div class="modal-body clearfix" id="report-result"><div class="row">
                                                <div class="col-md-12">

                                                    <div class="text-center">
                                                        <div class="row">
                                                            <div style="margin-right: 14%;">
                                                                <i class="fa fa-calendar-o" aria-hidden="true"></i>
                                                                <span>{{date('M', strtotime($test->start_date))}} {{date('d', strtotime($test->start_date))}}</span>

                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="paper_info">
                                                                <h5>{{$exams->name.' - '.$test->exam_type.' - '.$test->name}}</h5>
                                                                <ul>
                                                                    <li>{{$test->total_question}} Questions</li>
                                                                    <li>{{$test->hour}}h {{$test->min}}m Time</li>
                                                                    <li>{{$test->mark}} Marks</li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="report_outr">
                                                        <div class="report_in">
                                                            <div class="row">

                                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                                    @php
                                                                    $chapter_id_arr = [];
                                                                    @endphp
                                                                    @foreach($test->testSeriesSubject as $testSubject)
                                                                    <div class="media">
                                                                        <div class="media-left"><i class="fa fa-star" aria-hidden="true"></i></div>
                                                                        <div class="media-body">
                                                                            <h5>{{$testSubject->subject->name}}</h5>
                                                                            <ul class="disc-ul">
                                                                                @foreach($test->testSeriesChapter as $testChapter)
                                                                                @if($testChapter->chapter->subject_id == $testSubject->subject_id)
                                                                                @if(!in_array($testChapter->chapter->id ,$chapter_id_arr))
                                                                                <li class="disc-css">#{{$testChapter->chapter->name}}</li>
                                                                                @php
                                                                                $chapter_id_arr[] = $testChapter->chapter->id;
                                                                                @endphp
                                                                                @endif
                                                                                @endif
                                                                                @endforeach
                                                                            </ul>
                                                                        </div>
                                                                    </div>

                                                                    @endforeach


                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>




                                                </div>
                                            </div>
                                            <div style="padding-left:25%">
                                                <button class="btn_all next-btn" onclick="showInstructionsModal({{$test->id}})" style="width:300px">Read Instructions & Start Date</button>
                                                <!--<button class="skip_btn btn_all skip-btn" onclick="endSession()">End Session</button>-->

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="instruction_modal-{{$test->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            Instructions<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        </div>
                                        <div class="modal-body clearfix" id="report-result"><div class="row">
                                                <div class="col-md-12">

                                                    <div class="text-center">
                                                        <div class="row">
                                                            <div style="margin-right: 14%;">
                                                                <i class="fa fa-calendar-o" aria-hidden="true"></i>
                                                                <span>{{date('M', strtotime($test->start_date))}} {{date('d', strtotime($test->start_date))}}</span>

                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="paper_info">
                                                                <h5>{{$exams->name.' - '.$test->exam_type.' - '.$test->name}}</h5>
                                                                <ul>
                                                                    <li>{{$test->total_question}} Questions</li>
                                                                    <li>{{$test->hour}}h {{$test->min}}m Time</li>
                                                                    <li>{{$test->mark}} Marks</li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="report_outr">
                                                        <div class="report_in">
                                                            <div class="row">

                                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                                    
                                                                    <div class="media">
                                                                        <div class="media-left"><i class="fa fa-star" aria-hidden="true"></i></div>
                                                                        <div class="media-body">
                                                                            <h5>Points to remember</h5>
                                                                            <ul class="disc-ul">
                                                                                <li class="disc-css"> #You wil get only <strong>one chance</strong> to attemp this test.</li>
                                                                                <li class="disc-css">#Make sure you have good internet connection.</li>
                                                                                <li class="disc-css">#Maximize your browser window before starting the test.</li>
                                                                                
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                    <h2>Best of Luck!</h2>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>




                                                </div>
                                            </div>
                                            <div style="padding-left:25%">
                                                <button class="btn_all next-btn" onclick="startTest({{$test->id}})" style="width:300px">Start Test</button>
                                                <!--<button class="skip_btn btn_all skip-btn" onclick="endSession()">End Session</button>-->

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            @endforeach
                            
                            @if(count($missedTestSeries)==0)
                                <h4>No Tests Found.</h4>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="settings">
                <div class="paper_outer">
                    <div class="paper_block">
                        <h3 class="h3_head">{{$exams->name}}</h3>
                        <p class="sub_para">
                            All-India tests to help you monitor your progress, and gauge how well prepared you are for D-day. Compete with students from all over the country and compare your scores to find out where you stand.</p>
                        
                        <h2>Attempted Tests</h2>
                        <div class="row">

                            @foreach($attemptedTestSeries as $test)
                            
                            
                            <div class="col-md-6 col-md-6 col-md-12 target-year-container tg-{{$test->target_year}}" >
                                <div class="paper_inr clearfix">
                                    <div class=" ">
                                        <i class="fa fa-calendar-o" aria-hidden="true"></i>
                                        <span>{{date('M', strtotime($test->start_date))}} {{date('d', strtotime($test->start_date))}} </span>

                                    </div>
                                    <div class="paper_info">
                                        <h5>{{$exams->name.' - '.$test->exam_type.' - '.$test->name}} </h5>
                                        <ul>
                                            <li>{{$test->total_question}} Questions</li>
                                            <li>{{$test->hour}}h {{$test->min}}m Time</li>
                                            <li>{{$test->mark}} Marks</li>
                                        </ul>
                                    </div>
                                    <div class="clearfix"></div>
                                    <a href="{{url('exam/test/get-report/'.base64_encode($test->id))}}" >View Report</a>
                                </div>
                            </div>
                            <div class="modal fade" id="syllabus_modal-{{$test->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            Syllabus<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        </div>
                                        <div class="modal-body clearfix" id="report-result"><div class="row">
                                                <div class="col-md-12">

                                                    <div class="text-center">
                                                        <div class="row">
                                                            <div style="margin-right: 14%;">
                                                                <i class="fa fa-calendar-o" aria-hidden="true"></i>
                                                                <span>{{date('M', strtotime($test->start_date))}} {{date('d', strtotime($test->start_date))}}</span>

                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="paper_info">
                                                                <h5>{{$exams->name.' - '.$test->exam_type.' - '.$test->name}}</h5>
                                                                <ul>
                                                                    <li> {{$test->total_question}} Questions</li>
                                                                    <li> {{$test->hour}}h {{$test->min}}m Time</li>
                                                                    <li> {{$test->mark}} Marks</li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="report_outr">
                                                        <div class="report_in">
                                                            <div class="row">

                                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                                    @php
                                                                    $chapter_id_arr = [];
                                                                    @endphp
                                                                    @foreach($test->testSeriesSubject as $testSubject)
                                                                    <div class="media">
                                                                        <div class="media-left"><i class="fa fa-star" aria-hidden="true"></i></div>
                                                                        <div class="media-body">
                                                                            <h5>{{$testSubject->subject->name}}</h5>
                                                                            <ul class="disc-ul">
                                                                                @foreach($test->testSeriesChapter as $testChapter)
                                                                                @if($testChapter->chapter->subject_id == $testSubject->subject_id)
                                                                                @if(!in_array($testChapter->chapter->id ,$chapter_id_arr))
                                                                                <li class="disc-css">#{{$testChapter->chapter->name}}</li>
                                                                                @php
                                                                                $chapter_id_arr[] = $testChapter->chapter->id;
                                                                                @endphp
                                                                                @endif
                                                                                @endif
                                                                                @endforeach
                                                                            </ul>
                                                                        </div>
                                                                    </div>

                                                                    @endforeach


                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>




                                                </div>
                                            </div>
                                            <div style="padding-left:12%">
                                                <button class="btn_all next-btn" onclick="closeReportModal()">Continue</button>
                                                <button class="skip_btn btn_all skip-btn" onclick="endSession()">End Session</button>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            @endforeach
                            
                            @if(count($attemptedTestSeries)==0)
                                <h4>No Tests Found.</h4>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
 </div>
 </div>
    
    
@endsection

@section('footer')
<script>
    
    
    
  function disableF5(e){
      if(((e.which || e.keyCode) == 116) || (e.which || e.keyCode) == 82){
          e.preventDefault();
      }
  }
  

  $(function(){
        {{--  prevent user from refershing page --}}
      $(document).on("keydown",disableF5);
      $("html").on("contextmenu", function(e){ return false;});
  })  
  
  function showSyllabusModal(id){
      $("#syllabus_modal-"+id).modal('show')
  }
  function showInstructionsModal(id){
      $("#syllabus_modal-"+id).modal('hide')
      $("#instruction_modal-"+id).modal('show')
  }
  
  function startTest(id){
      if(confirm("Are you sure to start Test?"))
      {
          
          location.href = "{{url('tools/test-series/attempt-test/')}}/"+btoa(id);
      }
  }
  
  $(function(){
      $("#target-year").change(function(){

$(".target-year-container").hide()
$(".tg-"+$(this).val()).show()
})
  })
    </script>
@endsection

