@extends('layouts.admin')
@section('title')
Dashboard
@endsection
@section('content')
<div class="right_col" role="main">
          <!-- top tiles -->
          <div class="row tile_count">
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="glyphicon glyphicon-user"></i></div>
                  <div class="count">{{Auth::user()->totalStudent()}}</div>
                  <h3>Total Students</h3>
                  <p>Available.</p>
                </div>
              </div>
              
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="glyphicon glyphicon-user"></i></div>
                  <div class="count">{{Auth::user()->totalAdminUser()}}</div>
                  <h3>Total Sub-Admin</h3>
                  <p>Available.</p>
                </div>
              </div>
              
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="glyphicon glyphicon-user"></i></div>
                  <div class="count">{{Auth::user()->totalStandard()}}</div>
                  <h3>Total Standards</h3>
                  <p>Available.</p>
                </div>
              </div>
          
          <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="glyphicon glyphicon-user"></i></div>
                  <div class="count">{{Auth::user()->totalSubject()}}</div>
                  <h3>Total Subjects</h3>
                  <p>Available.</p>
                </div>
              </div>
          
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="glyphicon glyphicon-user"></i></div>
                  <div class="count">{{Auth::user()->totalChapter()}}</div>
                  <h3>Total Chapters</h3>
                  <p>Available.</p>
                </div>
              </div>
              
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="glyphicon glyphicon-user"></i></div>
                  <div class="count">{{Auth::user()->totalTopic()}}</div>
                  <h3>Total Topics</h3>
                  <p>Available.</p>
                </div>
              </div>
              
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="glyphicon glyphicon-user"></i></div>
                  <div class="count">{{Auth::user()->totalQuestionAnswer()}}</div>
                  <h3>Total Q&A</h3>
                  <p>Available.</p>
                </div>
              </div>
          <!-- /top tiles -->

          </div>
        </div>
@endsection

@section('footer')

@endsection