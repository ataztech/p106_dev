




  <div class="row">
    <div class="col-md-12">
    <h4>Report</h4>
    <!--<h5>dsxdxszxds</h5>--> 
      <div class="report_outr">
          <div class="report_in">
            <div class="row">
              <div class="col-md-6 col-sm-6 col-xs-12">
                  <div class="media">
                    <div class="media-left"><i class="fa fa-percent" aria-hidden="true"></i></div>
                      <div class="media-body">
                        <h5><b>{{$overall_progress}}%</b></h5>
                        <p>Completed</p>
                      </div>
                    </div>
                    <div class="media">
                    <div class="media-left"><i class="fa fa-question" aria-hidden="true"></i></div>
                      <div class="media-body">
                        <h5>{{$total_question_answered}}</h5>
                        <p>Questions Practiced</p>
                      </div>
                  </div>
                  
                  
                  
                <div class="media">
                    <div class="media-left"><i class="fa fa-clock-o" aria-hidden="true"></i></div>
                      <div class="media-body">
                        <h5>{{$time_taken}} mins</h5>
                        <p>Time Taken</p>
                      </div>
                  </div>
                  
              </div>
              <div class="col-md-6 col-sm-6 col-xs-12">
                  <div class="media">
                    <div class="media-left"><i class="fa fa-star" aria-hidden="true"></i></div>
                      <div class="media-body">
                         <h5>{{$total_question_correct_answer}}</h5>
                        <p>Correct Answer</p>
                      </div>
                  </div>
                  <div class="media">
                    <div class="media-left"><i class="fa fa-star"></i></div>
                      <div class="media-body">
                        <h5>{{$total_question_wrong_answer}}</h5>
                        <p>Wrong Answer</p>
                      </div>
                  </div>
                  
                  <div class="media">
                    <div class="media-left"><i class="fa fa-star" aria-hidden="true"></i></div>
                      <div class="media-body">
                        <h5>{{$total_question_skipped_answer}}</h5>
                        <p>Skipped Answer</p>
                      </div>
                  </div>
              </div>
            </div>
          </div>
      </div>
      
      
      <div class="report_outr">
          <div class="report_in">
            <div class="row">
              <div class="col-md-4 col-sm-4 col-xs-4">
                  <div class="media">
                    <div class="media-left"><i class="fa fa-eye"></i></div>
                      <div class="media-body">
                        <h5><b>Accuracy</b></h5>
                        
                      </div>
                  </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-4">
                  <div class="media">
                      <div class="media-body">
                        <h5>{{$accuracy}}%</h5>
                        
                      </div>
                  </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-4">
                  <div class="media">
                      <div class="media-body">
                         
                      </div>
                  </div>
              </div>
            </div>
            
          </div>
      </div>
      <div class="report_outr">
          <div class="report_in">
            <div class="row">
              <div class="col-md-4 col-sm-4 col-xs-4">
                  <div class="media">
                      <div class="media-left"><i class="fa fa-bolt"style="background-color: #1a237e"></i></div>
                      <div class="media-body">
                        <h5><b>Speed</b></h5>
                        
                      </div>
                  </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-4">
                  <div class="media">
                      <div class="media-body">
                          <h5>{{$speed>200?'200+':$speed}} <span>Questions/Hour</span></h5>
                        
                      </div>
                  </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-4">
                  <div class="media">
                      <div class="media-body">
                         
                      </div>
                  </div>
              </div>
            </div>
            
          </div>
      </div>
    </div>
  </div>
    <div style="padding-left:12%">
      <button class="btn_all next-btn"  onclick="closeReportModal()">Continue</button>
      @if($url == -1)
      <button   class="skip_btn btn_all skip-btn" onclick="endSession()">End Session</button>
      @else
      
      <button   class="skip_btn btn_all skip-btn" onclick="window.location.href = '{{$url}}'">End Session</button>
      
      @endif
      
    </div>

