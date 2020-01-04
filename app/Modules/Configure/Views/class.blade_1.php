

<style>
    @import url('https://fonts.googleapis.com/css?family=Open+Sans:700');


body {
	margin:0;
	height:100vh;
	width:100vw;
	background: rgba(179,220,237,1);
background: -moz-linear-gradient(left, rgba(179,220,237,1) 0%, rgba(41,184,229,1) 50%, rgba(188,224,238,1) 100%);
background: -webkit-gradient(left top, right top, color-stop(0%, rgba(179,220,237,1)), color-stop(50%, rgba(41,184,229,1)), color-stop(100%, rgba(188,224,238,1)));
background: -webkit-linear-gradient(left, rgba(179,220,237,1) 0%, rgba(41,184,229,1) 50%, rgba(188,224,238,1) 100%);
background: -o-linear-gradient(left, rgba(179,220,237,1) 0%, rgba(41,184,229,1) 50%, rgba(188,224,238,1) 100%);
background: -ms-linear-gradient(left, rgba(179,220,237,1) 0%, rgba(41,184,229,1) 50%, rgba(188,224,238,1) 100%);
background: linear-gradient(to right, rgba(179,220,237,1) 0%, rgba(41,184,229,1) 50%, rgba(188,224,238,1) 100%);
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#b3dced', endColorstr='#bce0ee', GradientType=1 );
	overflow:hidden;
}

*{
	box-sizing:border-box;
}

#page{
	width:100%;
	height:80%;
	display:flex;
	justify-content:center;
	align-items:center;
}


#center {
	position:absolute;
	z-index:5;
   background-color: silver;	
	transition:0.25s;
	animation:float 1s infinite;
}

#center .icon{
	padding:40px 0px;
	position:relative;
	height:100%;
	width:100%;
	display:flex;
	flex-direction:column;
	justify-content:space-around;
	align-items:center;
/* 	transform: skew(-50deg); */
}

.bar{
	height:15px;
	width:50%;
/* 	border-radius:25px; */
	background:#000000;
}

.btn{
	width: 200px;
   height: 200px;
}

nav{
	position:relative;
	transform: rotateX(60deg) rotateY(0deg) rotateZ(-45deg);
/* 	transform: rotate(-30deg) skew(30deg,0deg); */
	width:200px;
	height:200px;
}

.btn.item{
	position:absolute;
	top:0;
	z-index:1;
	transition: all 0.25s ease-out;
	left:0px;
	top:0px;
	opacity:1;
}

.btn.item:not(.opened){
	background:rgba(255, 255, 255,0.5);
}

#center:hover{
	cursor:pointer;
	background:#ff1464 !important;
}

#center:hover .bar{
	background:#ffffff;
}

.btn.item span:hover{
	cursor:pointer;
	background:#ff1464 !important;
	color:#ffffff !important;
}

.btn.item span{
	opacity:0;
}

.btn.item.opened span{
	opacity:1;
	background:silver;
	color:#000000;
	padding:0 15px;
}

.btn.item.opened{
	font-family:'open sans';

	font-size:5rem;
	display:flex;
	justify-content:center;
	align-items:center;
}

#up,#bottom{
	top:20px;
	left:-20px;
}

#right,#left{
	top:40px;
	left:-40px;
}

#up.opened{
	top:-100%;
	left:0;
}

#right.opened{
	left:140%;
	top:0;
}

#bottom.opened{
	top:100%;
	left:0;
}

#left.opened{
	left:-140%;
	top:0;
}

#center.close .bar.top{
	position:absolute;
	top:40px;
	left:50px;
	transform-origin:center left;
	transform:rotateZ(45deg);
	width:70%;
}

#center.close .bar.bottom{
	position:absolute;
	bottom:40px;
	left:50px;
	transform-origin:center left;
	transform:rotateZ(-45deg);
	width:70%;
}

#center.close .bar.middle{
	width:0
}


@keyframes float {
  0%,100% {
    top: 0px;
	 left:0px;
  }

  50% {
    top: -5px;
	 left:5px;
  }
}
</style>

<center>
<h1 style="
    color: #ffff;
    font-size: 48px;
    padding-top: 43px;
        letter-spacing: 0.1em;
">Select Your Class</h1>
</center>
<div id="page">
	<nav>
		<div id="center" class="btn">
			<div class="icon">
				<div class="bar top"></div>
				<div class="bar middle"></div>
				<div class="bar bottom"></div>
			</div>
		</div>
<!--		<div id="up" class="btn item">
			<span onclick="window.location='{{url('user/configure/save-class/11th')}}'">11th</span>
		</div>-->
		<div id="right" class="btn item">
                    <span  onclick="window.location='{{url('user/configure/save-class/12th')}}'">12th</span>
		</div>
<!--		<div id="bottom" class="btn item">
			<span onclick="window.location='{{url('user/configure/save-class/12th')}}'">12th</span>
		</div>-->
		<div id="left" class="btn item">
			<span onclick="window.location='{{url('user/configure/save-class/11th')}}'">11th</span>
		</div>
	</nav>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/snap.svg/0.5.1/snap.svg-min.js"></script>

<script>
    const navItems = document.querySelectorAll('nav .item');

document.querySelector('#center').addEventListener('click',function(){
	for(let i=0;i<navItems.length;i++){
		navItems[i].classList.toggle('opened')
	}
	document.querySelector('#center').classList.toggle('close')
})
    </script>