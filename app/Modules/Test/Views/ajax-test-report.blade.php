
<style>
    .afq-media{
        padding-top: 6%;
    }
</style>



  <div class="row">
    <div class="col-md-12">
    <h4>Paused</h4>
    <!--<h5>dsxdxszxds</h5>--> 
      <div class="report_outr">
          <div class="report_in">
            <div class="row">
              <div class="col-md-6 col-sm-6 col-xs-6">
                  <div class="media afq-media">
                    <div class="media-left"><i class="fa fa-eye"></i></div>
                      <div class="media-body">
                        <h5>Attempted Questions</h5>
                        
                      </div>
                  </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-6">
                  <div class="media">
                      <div class="media-body">
                          <h4><b><big><big><big>{{$total_question_attempted}}</big></big></big></b></h4>
                        
                      </div>
                  </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-6">
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
              <div class="col-md-6 col-sm-6 col-xs-6">
                  <div class="media afq-media">
                      <div class="media-left"><i class="fa fa-bolt"style="background-color: #1a237e"></i></div>
                      <div class="media-body">
                        <h5>Unattempted Questions</h5>
                        
                      </div>
                  </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-6">
                  <div class="media">
                      <div class="media-body">
                          <h4><b><big><big><big>{{$total_question_unattempted}}</big></big></big></b></h4>
                        
                      </div>
                  </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-6">
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
      <button   class="skip_btn btn_all skip-btn" onclick="endSession()">End Test</button>
      
    </div>

