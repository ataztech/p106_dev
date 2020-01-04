
<style>
    @import url(https://fonts.googleapis.com/css?family=Roboto:300,400,500);
html, body, div, span, applet, object, iframe,
h1, h2, h3, h4, h5, h6, p, blockquote, pre,
a, abbr, acronym, address, big, cite, code,
del, dfn, em, img, ins, kbd, q, s, samp,
small, strike, strong, sub, sup, tt, var,
b, u, i, center,
dl, dt, dd, ol, ul, li,
fieldset, form, label, legend,
table, caption, tbody, tfoot, thead, tr, th, td,
article, aside, canvas, details, embed,
figure, figcaption, footer, header, hgroup,
menu, nav, output, ruby, section, summary,
time, mark, audio, video {
  margin: 0;
  padding: 0;
  border: 0;
  font: inherit;
  font-size: 100%;
  vertical-align: baseline;
}

html {
  line-height: 1;
}

ol, ul {
  list-style: none;
}

table {
  border-collapse: collapse;
  border-spacing: 0;
}

caption, th, td {
  text-align: left;
  font-weight: normal;
  vertical-align: middle;
}

q, blockquote {
  quotes: none;
}
q:before, q:after, blockquote:before, blockquote:after {
  content: "";
  content: none;
}

a img {
  border: none;
}

article, aside, details, figcaption, figure, footer, header, hgroup, main, menu, nav, section, summary {
  display: block;
}

* {
  box-sizing: border-box;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}

html {
  height: 100%;
  min-height: 100%;
}

body {
  padding: 48px 5%;
  font-family: "Roboto", sans-serif;
  font-size: 14px;
  font-weight: 400;
  text-align: center;
  color: rgba(0, 0, 0, 0.54);
  background-color: #000;
  
}

.title {
  font-size: 54px;
  font-weight: 300;
  margin-bottom: 54px;
}
.title small {
  font-size: 16px;
}

.link {
  display: block;
  color: rgba(0, 0, 0, 0.54);
  margin-top: 54px;
}

.checkbox-input {
  display: none;
}

.checkbox-label, .checkbox-text, .checkbox-text--description {
  transition: all 0.4s ease;
}

.checkbox-label {
  display: inline-block;
  vertical-align: top;
  position: relative;
  width: 100%;
  padding: 30px 60px;
  cursor: pointer;
  font-size: 24px;
  font-weight: 400;
  margin: 16px 0;
  border: 1px solid #d9d9d9;
  border-radius: 2px;
    box-shadow: 0px 0px 13px 2px #ccc;
    border-radius: 3%;
      background: #fff;
}
.checkbox-label:before {
  content: "";
  position: absolute;
  top: 75%;
  right: 16px;
  width: 40px;
  height: 40px;
  opacity: 0;
  background-color: #2196F3;
  background-image: url(http://lorenzodianni.io/codepen/icon/done--white.svg);
  background-position: center;
  background-repeat: no-repeat;
  background-size: 24px;
  border-radius: 50%;
  -webkit-transform: translate(0%, -50%);
  transform: translate(0%, -50%);
  transition: all 0.4s ease;
}

.checkbox-text--title {
  font-weight: 500;
}
.checkbox-text--description {
  font-size: 14px;
  margin-top: 16px;
  padding-top: 16px;
  border-top: 1px solid #2196F3;
}
.checkbox-text--description .un {
  display: none;
}

.checkbox-input:checked + .checkbox-label {
  border-color: #2196F3;
  box-shadow: inset 0 -12px 0 0 #2196F3;
}
.checkbox-input:checked + .checkbox-label:before {
  top: 0;
  opacity: 1;
}
.checkbox-input:checked + .checkbox-label .checkbox-text {
  -webkit-transform: translate(0, -8px);
  transform: translate(0, -8px);
}
.checkbox-input:checked + .checkbox-label .checkbox-text--description {
  border-color: #d9d9d9;
}
.checkbox-input:checked + .checkbox-label .checkbox-text--description .un {
  display: inline-block;
}

@media screen and (min-width: 540px) {
  .checkbox-label {
    width: 450px;
    margin: 16px;
    min-height: 160px;
  }
}
.fullform{
    font-size: small;
    display: block;
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
  <center>
<h1 style="
   color: #ffff;
    font-size: 48px;
    padding-top: 9px;
    letter-spacing: 0.1em;
    margin: 0px;
">Select Your Board</h1>
</center>
<br>

<form action='{{url('user/configure/save-board')}}' id="form-board">
    
@foreach($data as $obj)
<input type="checkbox" name="board" value="{{$obj->id}}" id="tonnarelli{{$obj->id}}" class="checkbox-input"/>
<label for="tonnarelli{{$obj->id}}" class="checkbox-label">
  <div class="checkbox-text">
    <p class="checkbox-text--title">{{$obj->name}} <span class="fullform">({{$obj->full_form_name}})</span></p>
    <p class="checkbox-text--description">Click to <span class="un">un</span>select it!</p>
  </div>
</label>
@endforeach
</form>

<!--<input type="checkbox" name="pasta" id="spaghetti" class="checkbox-input"/>
<label for="spaghetti" class="checkbox-label">
  <div class="checkbox-text">
    <p class="checkbox-text--title">Maharashtra State Board <span class="fullform">(Maharashtra State Board of Secondary and Higher Secondary Education)</p>
    <p class="checkbox-text--description">Click to <span class="un">un</span>select it!</p>
  </div>
</label>

<input type="checkbox" name="pasta" id="fettuccine" class="checkbox-input"/>
<label for="fettuccine" class="checkbox-label">
  <div class="checkbox-text">
    <p class="checkbox-text--title">ICSE<span class="fullform">(Indian Certificate of Secondary Education)</span></p>
    <p class="checkbox-text--description">Click to <span class="un">un</span>select it!</p>
  </div>
</label>

<input type="checkbox" name="pasta" id="ravioli" class="checkbox-input"/>
<label for="ravioli" class="checkbox-label">
  <div class="checkbox-text">
    <p class="checkbox-text--title">Andhra Pradesh State Board <span class="fullform">(Andhra Pradesh Board of Secondary Education)</p>
    <p class="checkbox-text--description">Click to <span class="un">un</span>select it!</p>
  </div>
</label>-->

<div class="footer-nav">
<a href="{{url('user/configure/prepare')}}" class="previous">&laquo; Previous</a>
    

<a href="javascript:void(0)" onclick="$('#form-board').submit()" class="next">{{Session::has('competitive_exam')?'Next':'Finish'}} &raquo;</a>

  <script src="{{url('/')}}/public/frontend/jquery/dist/jquery.min.js"></script>
  
  <script>
      $(function(){
     $("input:checkbox").on('click', function() {
  // in the handler, 'this' refers to the box clicked on
  var $box = $(this);
  if ($box.is(":checked")) {
    // the name of the box is retrieved using the .attr() method
    // as it is assumed and expected to be immutable
    var group = "input:checkbox[name='" + $box.attr("name") + "']";
    // the checked state of the group/box on the other hand will change
    // and the current value is retrieved using .prop() method
    $(group).prop("checked", false);
    $box.prop("checked", true);
  } else {
    $box.prop("checked", false);
  }
});
      })
      </script>