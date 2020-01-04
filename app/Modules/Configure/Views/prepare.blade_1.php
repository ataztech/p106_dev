<style>
 @import url("https://fonts.googleapis.com/css?family=Montserrat:400,600");
*,
html {
  box-sizing: border-box;
}

*, *:before, *:after {
  box-sizing: inherit;
}

body {
  font-family: "Montserrat";
  font-size: 22px;
background: rgba(179,220,237,1);
background: -moz-linear-gradient(left, rgba(179,220,237,1) 0%, rgba(41,184,229,1) 50%, rgba(188,224,238,1) 100%);
background: -webkit-gradient(left top, right top, color-stop(0%, rgba(179,220,237,1)), color-stop(50%, rgba(41,184,229,1)), color-stop(100%, rgba(188,224,238,1)));
background: -webkit-linear-gradient(left, rgba(179,220,237,1) 0%, rgba(41,184,229,1) 50%, rgba(188,224,238,1) 100%);
background: -o-linear-gradient(left, rgba(179,220,237,1) 0%, rgba(41,184,229,1) 50%, rgba(188,224,238,1) 100%);
background: -ms-linear-gradient(left, rgba(179,220,237,1) 0%, rgba(41,184,229,1) 50%, rgba(188,224,238,1) 100%);
background: linear-gradient(to right, rgba(179,220,237,1) 0%, rgba(41,184,229,1) 50%, rgba(188,224,238,1) 100%);
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#b3dced', endColorstr='#bce0ee', GradientType=1 );
/*  background-size: 16px 16px;*/
}

.cpc_container {
  padding: 40px 100px;
  width: 100%;
  max-width: 710px;
  position: absolute;
  left: 50%;
  -webkit-transform: translateX(-50%);
          transform: translateX(-50%);
  color: white;
}

.pinnacle_checkbox input {
  display: none;
}
.pinnacle_checkbox label {
  display: block;
  height: 50px;
  width: 100px;
  border: 2px solid #E25E5E;
  transition: border .3s ease;
  border-radius: 5px;
  cursor: pointer;
  background-color: lightgray;
}
.pinnacle_checkbox label .unchecked_area {
  width: 50%;
  height: 100%;
  background-color: #E25E5E;
  transition: width .3s;
  float: left;
  border-top-left-radius: 4px;
  border-bottom-left-radius: 4px;
  box-shadow: inset 0px 0px 21px -2px rgba(0, 0, 0, 0.75);
}
.pinnacle_checkbox label .checked_area {
  width: 0%;
  height: 100%;
  background-color: #64BE7C;
  transition: width .3s;
  float: right;
  border-top-right-radius: 4px;
  border-bottom-right-radius: 4px;
  box-shadow: inset 0px 0px 21px -2px rgba(0, 0, 0, 0.75);
}
.pinnacle_checkbox input:checked + label {
  border: 2px solid #64BE7C;
}
.pinnacle_checkbox input:checked + label .unchecked_area {
  width: 0%;
}
.pinnacle_checkbox input:checked + label .checked_area {
  width: 50%;
}

.question {
  margin-bottom: 60px;
}
.question .question_title {
  margin-bottom: 20px;
}

.summary_content {
  width: 100%;
  border: 2px solid #E25E5E;
  border-radius: 5px;
  background-color: white;
  font-size: 14px;
  transition: border .3s ease;
  max-width: 500px;
}
.summary_content.valid {
  border: 2px solid #64BE7C;
}

.summary_title {
  margin-bottom: 20px;
}

.summary_entry {
  padding: 20px;
  border-left: 20px solid #E25E5E;
  transition: border-left .3s ease;
  color: black;
}
.summary_entry.valid {
  border-left: 20px solid #64BE7C;
}

/*footer code*/
a {
    text-decoration: none;
    display: inline-block;
    padding: 8px 16px;
}

a:hover {
    background-color: #ddd;
    color: black;
}

.previous {
    background-color: #f1f1f1;
    color: black;
        position: fixed;
    left: 4%;
}

.next {
    background-color: #4CAF50;
    color: white;
        position: fixed;
    right: 6%;
}

.footer-nav{
    
    position: fixed;
    bottom: 12%;

}
.round {
    border-radius: 50%;
}
/*footer code end*/

    </style>

<div class="cpc_container">  
    <form action="{{url('user/configure/save-prepare')}}" id="form-prepare">
        <div class="questions">
            <div class="question">
                <div class="question_title">Do you want to prepare for Board Exams?</div>
                <div class="pinnacle_checkbox">
                    <input name="board_exam" type="checkbox" id="board_exam" data-summary="promo_email_sum"></input>
                    <label for="board_exam">
                        <div class="unchecked_area"></div>
                        <div class="checked_area"></div>
                    </label>
                </div>
            </div>
            <div class="question">
                <div class="question_title">Do you want to prepare for Competitive Exams?</div>
                <div class="pinnacle_checkbox">
                    <input type="checkbox" name="competitive_exam" id="competitive_exam" data-summary="terms_sum"></input>
                    <label for="competitive_exam">
                        <div class="unchecked_area"></div>
                        <div class="checked_area"></div>
                    </label>
                </div>
            </div>
        </div>
    </form>

        <div class="summary">
            <div class="summary_title">Summary</div>
            <div class="summary_content">
                <div class="summary_entry promo_email_sum"></div>
                <div class="summary_entry terms_sum"></div>
                
            </div>
        </div>
    </div>
    <div class="footer-nav">
<a href="{{url('user/configure/stream')}}" class="previous">&laquo; Previous</a>

<a href="javascript:void(0)" onclick="$('#form-prepare').submit()" class="next next-button">Next &raquo;</a>
<!--<a href="{{url('user/configure/board')}}" class="next next-button">Next &raquo;</a>-->
</div>
    <script src="{{url('/')}}/public/frontend/jquery/dist/jquery.min.js"></script>
    <script>
        // Object that stores summary text.
var summary_wordage = {
    promo_email_sum: {
        unchecked: "You haven't selected Board Exam.",
        checked: "You have selected Board Exam."
        
    },
    terms_sum: {
        unchecked:  "You haven't selected Competitive  Exam.",
        checked: "You have selected Competitive  Exam."
    }
}



function updateSummary(checkbox) {

    // Field is the id of selected checkbox. This is required to get the correct text to update the summary.
    var summary = checkbox.getAttribute("data-summary");

    // Status is whether the checkbox is checked or unchecked.
    var status = checkbox.checked ? "checked" : "unchecked";

    // Wordage is the text that will be used in the summary.
    var wordage = summary_wordage[summary][status];

    // The summary element that will be updated.
    var summary_element = document.querySelector("." + summary);

    if (checkbox.checked) {
        summary_element.classList.add("valid");
    } else {
        summary_element.classList.remove("valid");
    }

    // Updates text in summary entry.
    summary_element.innerHTML = wordage;



     // Summary content is the element that wraps all of the summary entries.
     var summary_content = document.querySelector(".summary_content");

     // Stores an array of the summary entry elements.
     var summary_entries = document.querySelectorAll(".summary_entry");
 
     // Initialiser variable that's used to give the green border when all summary entries are valid/checked.
     var all_valid = true;



    // If a summary entry doesn't contain the valid class, then set don't apply the green border around summary content.
    
    var next_button_flag = false;
    for (var i = 0; i < summary_entries.length; i++) {
        if (!summary_entries[i].classList.contains("valid")) {
            all_valid = false;
             next_button_flag = true;
        }else{
           
        }
    }

if($("input[type=checkbox]:checked").length>0)
{
    $(".next-button").show();
}else{
    $(".next-button").hide();
}


    if (all_valid) {
        
        summary_content.classList.add("valid");
    } else {

        summary_content.classList.remove("valid");
    }




}



// Stores array of checkbox elements
var checkboxes = document.querySelectorAll(".pinnacle_checkbox input");

for (var i = 0; i < checkboxes.length; i++) {

    // Sets event listeners on checkboxes to update summary on change.
    checkboxes[i].addEventListener('change', (event) => {
        updateSummary(event.target);
    })

    // Sets summary content on first load
    updateSummary(checkboxes[i]);
}



        </script>