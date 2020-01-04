
                <div class="row">
                    <div class="col-lg-9">
                        <div class="card">
                            <div class="card-title">
                                <h4>{{$question_answer->question}}</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table answers">
                                      
                                        <tbody>

                                            <tr class="answer-option option1" onclick="checkAnswer({{$question_answer->id}},1, this)">
                                                <td style="width: 10px;">
                                                    <span class="badge badge-dark">1</span>
                                                </td>
                                                    <td colspan="4" style="text-align: left">{!!$question_answer->option_1!!}<span class="badge badge-answer"></span></td>
                                                
                                            </tr>
                                            <tr class="answer-option option2" onclick="checkAnswer({{$question_answer->id}},2, this)">
                                                <td style="width: 10px;">
                                                    <span class="badge badge-dark">2</span>
                                                </td>
                                                <td colspan="4" style="text-align: left">{!!$question_answer->option_2!!} <span class="badge badge-answer"></span></td>
                                                
                                            </tr>
                                            <tr class="answer-option option3" onclick="checkAnswer({{$question_answer->id}},3, this)">
                                                <td style="width: 10px;">
                                                    <span class="badge badge-dark">3</span>
                                                </td>
                                                <td colspan="4" style="text-align: left">{!!$question_answer->option_3!!} <span class="badge badge-answer"></span></td>
                                                
                                            </tr>
                                            <tr class="answer-option option4" onclick="checkAnswer({{$question_answer->id}},4, this)">
                                                <td style="width: 10px;">
                                                    <span class="badge badge-dark">4</span>
                                                </td>
                                                <td colspan="4" style="text-align: left">{!!$question_answer->option_4!!} <span class="badge badge-answer"></span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card solution-container" style="display:none">
                            <div class="card-body">
                                
                                <div class="card-content">
                                    <div class="alert alert-success solution">
                                        <h4 class="alert-heading">Solution</h4>
                                        <p>
                                            {!!$question_answer->reason!!}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div style="text-align:center" class="skip-btn"><button class="btn btn-info assess-btn">Skip This Question</button> </div>
                        <div style="text-align:center; display:none" class="next-btn" ><button type="button" class="btn btn-success btn-flat m-b-10 m-l-5 assess-btn" onclick="nextQuestion()">Next</button> </div>
                        <div style="text-align:center; display:none" class="finish-btn" ><button type="button" class="btn btn-success btn-flat m-b-10 m-l-5 assess-btn" onclick="nextQuestion()">Finish</button> </div>
                       
                    </div>
                    
                </div>

         
  