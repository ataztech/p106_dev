@extends('layouts.front')
@section('title')
    ATAZ Learning
@endsection
@section('content')
<style>
	
	@import url('https://fonts.googleapis.com/css?family=Mountains+of+Christmas:700');
body, html {
  height: 100%;
}
body {
  background: #b01c1c;
}
.holidays-title {
  font-family: 'Mountains of Christmas', cursive;
  font-size: 3em;
  background: #fff;
  padding: 20px;
  border-radius: 20px;
  box-shadow: 2px 2px 1px 1px rgba(0, 0, 0, 0.14);
  position: relative;
  opacity: 0;
  animation: balloon 6s ease-in-out infinite;
}
.holidays-title::before {
  position: absolute;
  content: '';
  width: 0;
  height: 0;
  border-left: 30px solid transparent;
  border-right: 0 solid transparent;
  border-top: 40px solid #fff;
  bottom: -31px;
  right: 190px;
  transform: rotateZ(-20deg);
}
.wrapper {
  margin: 0;
  display: flex;
  height: inherit;
  flex-direction: column;
  align-items: center;
  justify-content: center;
}
.tree-stalk, .tree-jar, .room-window::before, .room-window::after, .sc-head .nose, .sc-head .beard::before, .sc-head .ears, .sc-hat {
  display: table;
  margin: 0 auto;
}
.tie-wrap::before, .tie-wrap::after {
  position: absolute;
  content: '';
  width: 0;
  height: 0;
  border-left: 17px solid transparent;
  border-right: 0 solid transparent;
  border-bottom: 40px solid yellow;
  left: 21px;
  top: 5px;
}
.ground {
  background: rgba(0, 0, 0, 0.12);
  width: calc(100vw - 20%);
  height: 70px;
  border-radius: 50%;
  display: table;
}
.scene {
  max-width: calc(100vw - 30%);
  min-width: 640px;
  position: relative;
}
.xmas-tree {
  position: relative;
  top: 80px;
  float: left;
}
.tree-star {
  position: absolute;
  top: 0;
  left: 40%;
  z-index: 4;
}
.tree-star::before {
  content: '';
  position: absolute;
  bottom: -16px;
  width: 0;
  height: 0;
  border-left: 15px solid transparent;
  border-right: 15px solid transparent;
  border-bottom: 25px solid #fcd000;
  box-shadow: 1px 19px 20px -7px #1d5022;
}
.tree-star::after {
  content: '';
  position: absolute;
  top: 0;
  width: 0;
  height: 0;
  border-left: 15px solid transparent;
  border-right: 15px solid transparent;
  border-top: 25px solid #fcd000;
}
.tree-part {
  width: 0;
  height: 0;
  border-left: 80px solid transparent;
  border-right: 80px solid transparent;
  border-bottom: 100px solid #49bd55;
  position: relative;
  z-index: 3;
}
.tree-part::before {
  content: '';
  position: absolute;
  width: 160px;
  background-repeat: repeat;
  height: 15px;
  background-size: 20px 20px;
  background-image: radial-gradient(circle at 10px 15px, #3fae4a 12px, transparent 13px);
  top: 99px;
  left: -80px;
  transform: rotateX(180deg);
}
.tree-part:nth-child(2) {
  border-bottom-color: #31883a;
  transform: scale(1.4);
  top: -45px;
  z-index: 2;
}
.tree-part:nth-child(2)::before {
  background-image: radial-gradient(circle at 10px 15px, #389b42 12px, transparent 13px);
}
.tree-part:nth-child(3) {
  border-bottom-color: #2b7532;
  transform: scale(1.8);
  top: -80px;
  z-index: 1;
}
.tree-part:nth-child(3)::before {
  background-image: radial-gradient(circle at 10px 15px, #31883a 12px, transparent 13px);
}
.tree-stalk {
  width: 25px;
  height: 75px;
  background: #7b652d;
  box-shadow: inset 0 22px 6px -1px #302812;
  position: relative;
  top: -40px;
}
.tree-jar {
  width: 80px;
  position: relative;
  top: -40px;
  left: 2px;
}
.tree-jar::before {
  content: '';
  width: 96px;
  height: 20px;
  float: left;
  background: #584444;
  box-shadow: 0 3px 2px -1px #4a3939;
  position: relative;
  border-radius: 2px;
  left: -3px;
}
.tree-jar::after {
  content: '';
  border-top: 50px solid #755a5a;
  border-left: 20px solid transparent;
  border-right: 20px solid transparent;
  height: 0;
  width: 50px;
  float: left;
}
.tree-lights {
  width: 120px;
  height: 20px;
  border-radius: 50%;
  box-shadow: 0 3px 0 -1px #000;
}
.tree-lights.left {
  transform: rotateZ(-20deg);
  position: relative;
  left: -73px;
  top: 41px;
}
.tree-lights.right {
  transform: rotateY(180deg) rotateZ(-20deg);
  position: relative;
  left: -43px;
  top: 31px;
}
.light-bulb {
  width: 8px;
  height: 3px;
  background: black;
  margin: 20px;
  border-radius: 20% 50%;
  position: absolute;
  animation: 1s cubic-bezier(0.39, 0.58, 0.57, 1) infinite;
}
.light-bulb.red {
  background: #de3939;
  box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.14), 0 2px 6px 2px #de3939;
  transform: rotateZ(-73deg);
  top: 2px;
  left: -9px;
  animation-name: blink;
}
.light-bulb.yew {
  background: #69e622;
  box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.14), 0 2px 6px 2px #69e622;
  transform: rotateZ(-86deg);
  top: 6px;
  left: 20px;
  animation-name: blink2;
}
.light-bulb.purple {
  background: #9c6aff;
  box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.14), 0 2px 6px 2px #9c6aff;
  transform: rotateZ(-96deg);
  top: 6px;
  left: 50px;
  animation-name: blink3;
}
.light-bulb.blue {
  background: #0ebeff;
  box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.14), 0 2px 6px 2px #0ebeff;
  transform: rotateZ(-106deg);
  top: 3px;
  left: 75px;
  animation-name: blink4;
}
.room-window {
  width: 340px;
  height: 300px;
  border: 10px solid #ccaa53;
  box-shadow: 4px 5px 2px 0px rgba(182, 146, 54, 0.3);
  float: right;
  overflow: hidden;
  position: relative;
}
.room-window::before {
  content: '';
  background: #ccaa53;
  box-shadow: 1px 0 1px 1px #a28230;
  width: 10px;
  height: inherit;
  position: absolute;
  left: 48%;
  z-index: 1;
}
.room-window::after {
  content: '';
  background: #ccaa53;
  width: inherit;
  height: 10px;
  position: absolute;
  top: 48%;
  z-index: 1;
}
.room-window .xmas-sky {
  background: linear-gradient(0deg, #153d54, #061117);
  width: 100%;
  height: 100%;
  position: absolute;
}
.snow-ground {
  width: 455px;
  height: 105px;
  background: linear-gradient(0deg, #fff, #ccf0fd);
  border-radius: 40%;
  position: absolute;
  bottom: -44px;
  left: -24px;
  transform: rotateZ(-6deg);
}
.xmas-gifts {
  position: absolute;
  bottom: -41px;
  left: 176px;
}
.xmas-gift {
  border-radius: 4px;
}
.xmas-gift::before {
  content: '';
  width: 100%;
  height: 10px;
  background: yellow;
  box-shadow: -30px 0 0 0 #d6d600;
  display: block;
  position: relative;
  top: 35px;
}
.xmas-gift::after {
  content: '';
  width: 10px;
  height: inherit;
  background: yellow;
  display: block;
  position: relative;
  top: -10px;
  margin: auto;
}
.xmas-gift.square {
  width: 80px;
  height: 80px;
  background: #ff54cf;
  box-shadow: -30px 0 0 0 #ed00aa;
  position: relative;
  z-index: 1;
}
.xmas-gift.rectangular {
  width: 60px;
  height: 120px;
  background: #0ebeff;
  box-shadow: -30px 0 0 0 #008dc1;
  position: absolute;
  top: -50px;
  left: 100px;
}
.tie-wrap {
  position: absolute;
  top: -20px;
  left: -6px;
  min-width: 82px;
}
.tie-wrap .tie, .tie-wrap .tie::before {
  width: 40px;
  height: 20px;
  background: yellow;
  border-radius: 50% 50% 20% 20%;
  float: left;
  z-index: 1;
  position: relative;
}
.tie-wrap .tie::before {
  content: '';
  background: #cc0;
  transform: scale(0.5) translateX(15px) translateY(8px);
}
.tie-wrap .tie.reflected, .tie-wrap .tie::before.reflected {
  transform: rotateY(180deg);
}
.tie-wrap .tie.reflected::before, .tie-wrap .tie::before.reflected {
  transform: scale(0.5) translateX(2px) translateY(8px);
}
.tie-wrap::after {
  transform: rotateY(180deg);
  left: 54px;
}
.rectangular .tie-wrap {
  left: -16px;
}
.santa-claus {
  margin: 40px;
  animation: santa-claus 6s ease-in infinite;
}
.sc-head {
  width: 80px;
  height: 80px;
  border-radius: 40%;
  background: #f7caaf;
  position: relative;
  z-index: 2;
}
.sc-head .eyes {
  position: absolute;
  left: 2px;
  top: 20px;
  display: table;
  margin: 0 auto;
}
.sc-head .eyes::before, .sc-head .eyes::after {
  content: '';
  width: 8px;
  height: 8px;
  background: #000;
  border-radius: 50%;
  display: inline-block;
  margin: 0 15px;
}
.sc-head .nose {
  width: 20px;
  height: 13px;
  border-radius: 50%;
  background: #d48c7e;
  top: 32px;
  position: relative;
}
.sc-head .beard {
  position: absolute;
  bottom: -45px;
  left: -10px;
  background: #fff;
  width: calc(100% + 20px);
  height: 80px;
  border-radius: 20% 20% 60% 60%;
}
.sc-head .beard::before {
  content: '';
  width: 20px;
  height: 20px;
  background: #000;
  border-radius: 0 0 50% 50%;
  margin-top: 6px;
}
.sc-head .ears {
  width: calc(100% + 17px);
  position: absolute;
  top: 25px;
  left: -8px;
}
.sc-head .ears .ear {
  width: 10px;
  height: 20px;
  background: #d48c7e;
  border-radius: 50% 0 0 50%;
}
.sc-head .ears .ear.left {
  float: left;
}
.sc-head .ears .ear.right {
  float: right;
  transform: rotateZ(180deg);
}
.sc-hat {
  position: absolute;
  top: -37px;
  left: -6px;
  width: calc(100% + 10px);
  height: 55px;
  background: #de3939;
  border-radius: 60px 80px 0 0;
}
.sc-hat::before {
  content: '';
  width: inherit;
  height: 20px;
  background: #fff;
  display: block;
  border-radius: 6px;
  position: absolute;
  bottom: -5px;
  left: -4px;
}
.sc-hat .hat-tip {
  width: 0;
  height: 0;
  border-left: 20px solid transparent;
  border-right: 20px solid transparent;
  border-bottom: 69px solid #de3939;
  position: absolute;
  top: -37px;
  animation: swing 2s cubic-bezier(0.45, 0.05, 0.55, 0.95) infinite;
  left: 8px;
}
.sc-hat .hat-tip::before {
  content: '';
  width: 20px;
  height: 20px;
  background: #fff;
  border-radius: 50%;
  display: block;
  position: absolute;
  left: -13px;
  top: -10px;
}
.sc-body {
  position: absolute;
  left: -70px;
  width: 200px;
  height: 200px;
  background: #de3939;
  border-radius: 30%;
}
.snow, .snow:before, .snow:after {
  position: absolute;
  top: -600px;
  left: 0;
  bottom: 0;
  right: 0;
  background-image: radial-gradient(5px 5px at 463px 435px, rgba(255, 255, 255, 0.7) 70%, rgba(0, 0, 0, 0)), radial-gradient(4px 4px at 510px 588px, rgba(255, 255, 255, 0.6) 70%, rgba(0, 0, 0, 0)), radial-gradient(4px 4px at 262px 132px, rgba(255, 255, 255, 0.7) 70%, rgba(0, 0, 0, 0)), radial-gradient(5px 5px at 183px 340px, rgba(255, 255, 255, 0.7) 70%, rgba(0, 0, 0, 0)), radial-gradient(4px 4px at 487px 528px, white 70%, rgba(0, 0, 0, 0)), radial-gradient(3px 3px at 579px 416px, rgba(255, 255, 255, 0.9) 70%, rgba(0, 0, 0, 0)), radial-gradient(5px 5px at 265px 494px, rgba(255, 255, 255, 0.7) 70%, rgba(0, 0, 0, 0)), radial-gradient(4px 4px at 477px 336px, rgba(255, 255, 255, 0.7) 70%, rgba(0, 0, 0, 0)), radial-gradient(4px 4px at 555px 200px, rgba(255, 255, 255, 0.9) 70%, rgba(0, 0, 0, 0)), radial-gradient(3px 3px at 147px 126px, rgba(255, 255, 255, 0.9) 70%, rgba(0, 0, 0, 0)), radial-gradient(3px 3px at 71px 189px, rgba(255, 255, 255, 0.7) 70%, rgba(0, 0, 0, 0)), radial-gradient(4px 4px at 399px 495px, rgba(255, 255, 255, 0.6) 70%, rgba(0, 0, 0, 0)), radial-gradient(5px 5px at 236px 166px, white 70%, rgba(0, 0, 0, 0)), radial-gradient(4px 4px at 529px 336px, rgba(255, 255, 255, 0.6) 70%, rgba(0, 0, 0, 0)), radial-gradient(5px 5px at 561px 502px, rgba(255, 255, 255, 0.9) 70%, rgba(0, 0, 0, 0)), radial-gradient(3px 3px at 480px 64px, rgba(255, 255, 255, 0.7) 70%, rgba(0, 0, 0, 0)), radial-gradient(5px 5px at 477px 162px, rgba(255, 255, 255, 0.6) 70%, rgba(0, 0, 0, 0)), radial-gradient(5px 5px at 471px 417px, rgba(255, 255, 255, 0.6) 70%, rgba(0, 0, 0, 0)), radial-gradient(4px 4px at 318px 109px, rgba(255, 255, 255, 0.6) 70%, rgba(0, 0, 0, 0)), radial-gradient(3px 3px at 547px 431px, rgba(255, 255, 255, 0.8) 70%, rgba(0, 0, 0, 0)), radial-gradient(3px 3px at 335px 359px, rgba(255, 255, 255, 0.9) 70%, rgba(0, 0, 0, 0)), radial-gradient(5px 5px at 548px 37px, rgba(255, 255, 255, 0.6) 70%, rgba(0, 0, 0, 0)), radial-gradient(4px 4px at 546px 30px, white 70%, rgba(0, 0, 0, 0)), radial-gradient(4px 4px at 278px 137px, rgba(255, 255, 255, 0.8) 70%, rgba(0, 0, 0, 0)), radial-gradient(3px 3px at 156px 351px, rgba(255, 255, 255, 0.7) 70%, rgba(0, 0, 0, 0)), radial-gradient(4px 4px at 53px 109px, rgba(255, 255, 255, 0.6) 70%, rgba(0, 0, 0, 0)), radial-gradient(3px 3px at 439px 416px, rgba(255, 255, 255, 0.7) 70%, rgba(0, 0, 0, 0)), radial-gradient(3px 3px at 119px 130px, rgba(255, 255, 255, 0.9) 70%, rgba(0, 0, 0, 0)), radial-gradient(5px 5px at 274px 425px, rgba(255, 255, 255, 0.7) 70%, rgba(0, 0, 0, 0)), radial-gradient(3px 3px at 93px 307px, rgba(255, 255, 255, 0.6) 70%, rgba(0, 0, 0, 0)), radial-gradient(3px 3px at 412px 170px, rgba(255, 255, 255, 0.8) 70%, rgba(0, 0, 0, 0)), radial-gradient(4px 4px at 215px 376px, rgba(255, 255, 255, 0.9) 70%, rgba(0, 0, 0, 0)), radial-gradient(3px 3px at 17px 285px, rgba(255, 255, 255, 0.6) 70%, rgba(0, 0, 0, 0)), radial-gradient(5px 5px at 459px 357px, rgba(255, 255, 255, 0.7) 70%, rgba(0, 0, 0, 0)), radial-gradient(5px 5px at 305px 112px, white 70%, rgba(0, 0, 0, 0)), radial-gradient(3px 3px at 377px 558px, rgba(255, 255, 255, 0.9) 70%, rgba(0, 0, 0, 0)), radial-gradient(5px 5px at 263px 52px, rgba(255, 255, 255, 0.8) 70%, rgba(0, 0, 0, 0)), radial-gradient(4px 4px at 49px 346px, white 70%, rgba(0, 0, 0, 0)), radial-gradient(3px 3px at 216px 297px, rgba(255, 255, 255, 0.7) 70%, rgba(0, 0, 0, 0)), radial-gradient(4px 4px at 325px 318px, white 70%, rgba(0, 0, 0, 0)), radial-gradient(5px 5px at 446px 304px, rgba(255, 255, 255, 0.8) 70%, rgba(0, 0, 0, 0)), radial-gradient(3px 3px at 92px 182px, rgba(255, 255, 255, 0.9) 70%, rgba(0, 0, 0, 0)), radial-gradient(3px 3px at 230px 230px, white 70%, rgba(0, 0, 0, 0)), radial-gradient(4px 4px at 513px 550px, rgba(255, 255, 255, 0.7) 70%, rgba(0, 0, 0, 0)), radial-gradient(4px 4px at 308px 522px, rgba(255, 255, 255, 0.6) 70%, rgba(0, 0, 0, 0)), radial-gradient(5px 5px at 561px 264px, rgba(255, 255, 255, 0.9) 70%, rgba(0, 0, 0, 0)), radial-gradient(4px 4px at 45px 383px, rgba(255, 255, 255, 0.7) 70%, rgba(0, 0, 0, 0)), radial-gradient(5px 5px at 444px 48px, rgba(255, 255, 255, 0.9) 70%, rgba(0, 0, 0, 0)), radial-gradient(5px 5px at 305px 199px, white 70%, rgba(0, 0, 0, 0)), radial-gradient(5px 5px at 233px 474px, white 70%, rgba(0, 0, 0, 0)), radial-gradient(3px 3px at 25px 587px, white 70%, rgba(0, 0, 0, 0)), radial-gradient(3px 3px at 482px 23px, white 70%, rgba(0, 0, 0, 0)), radial-gradient(3px 3px at 559px 276px, white 70%, rgba(0, 0, 0, 0)), radial-gradient(3px 3px at 271px 311px, rgba(255, 255, 255, 0.9) 70%, rgba(0, 0, 0, 0)), radial-gradient(5px 5px at 584px 177px, white 70%, rgba(0, 0, 0, 0)), radial-gradient(4px 4px at 437px 535px, white 70%, rgba(0, 0, 0, 0)), radial-gradient(4px 4px at 430px 455px, rgba(255, 255, 255, 0.9) 70%, rgba(0, 0, 0, 0)), radial-gradient(3px 3px at 397px 563px, rgba(255, 255, 255, 0.7) 70%, rgba(0, 0, 0, 0)), radial-gradient(4px 4px at 343px 573px, rgba(255, 255, 255, 0.6) 70%, rgba(0, 0, 0, 0)), radial-gradient(3px 3px at 298px 556px, white 70%, rgba(0, 0, 0, 0)), radial-gradient(5px 5px at 32px 586px, white 70%, rgba(0, 0, 0, 0)), radial-gradient(3px 3px at 202px 454px, rgba(255, 255, 255, 0.6) 70%, rgba(0, 0, 0, 0)), radial-gradient(5px 5px at 115px 126px, rgba(255, 255, 255, 0.8) 70%, rgba(0, 0, 0, 0)), radial-gradient(3px 3px at 510px 422px, rgba(255, 255, 255, 0.7) 70%, rgba(0, 0, 0, 0)), radial-gradient(4px 4px at 280px 332px, rgba(255, 255, 255, 0.6) 70%, rgba(0, 0, 0, 0)), radial-gradient(4px 4px at 517px 175px, rgba(255, 255, 255, 0.8) 70%, rgba(0, 0, 0, 0)), radial-gradient(5px 5px at 79px 234px, rgba(255, 255, 255, 0.8) 70%, rgba(0, 0, 0, 0)), radial-gradient(3px 3px at 510px 264px, white 70%, rgba(0, 0, 0, 0)), radial-gradient(5px 5px at 440px 512px, rgba(255, 255, 255, 0.6) 70%, rgba(0, 0, 0, 0)), radial-gradient(5px 5px at 522px 8px, rgba(255, 255, 255, 0.8) 70%, rgba(0, 0, 0, 0));
  background-size: 600px 600px;
  animation: snow 4s linear infinite;
  content: "";
}
.snow:after {
  margin-left: -200px;
  opacity: 0.4;
  animation-duration: 8s;
  animation-direction: reverse;
  filter: blur(3px);
}
.snow:before {
  animation-duration: 12s;
  animation-direction: reverse;
  margin-left: -300px;
  opacity: 0.65;
  filter: blur(1.5px);
}
@keyframes snow {
  to {
    transform: translateY(600px);
  }
}
@keyframes blink {
  20% {
    background: #eb8888;
  }
}
@keyframes blink2 {
  60% {
    background: white;
  }
}
@keyframes blink3 {
  75% {
    background: #d9c6ff;
  }
}
@keyframes blink4 {
  100% {
    background: #a7e7ff;
  }
}
@keyframes santa-claus {
  0%, 60%, 80%, 100% {
    transform: rotateZ(195deg) translateY(0);
  }
  30% {
    transform: rotateZ(195deg) translateY(300px);
  }
}
@keyframes swing {
  0%, 100% {
    transform: rotateZ(-42deg);
  }
  50% {
    transform: rotateZ(0deg);
  }
}
@keyframes balloon {
  0%, 50%, 100% {
    opacity: 0;
    transform: translateY(0px);
  }
  80%, 90% {
    opacity: 1;
    transform: translateY(-15px);
  }
}

// loader

*{margin:0;}
body{ font: 200 16px/1 sans-serif; }


#overlay{
  position:fixed;
  z-index:99999;
  top:0;
  left:0;
  bottom:0;
  right:0;
  background:rgba(0,0,0,0.9);
  transition: 1s 0.4s;
}
#progress{
  height:1px;
  background:#fff;
  position:absolute;
  width:0;                /* will be increased by JS */
  top:50%;
}
#progstat{
  font-size:0.7em;
  letter-spacing: 3px;
  position:absolute;
  top:50%;
  margin-top:-40px;
  width:100%;
  text-align:center;
  color:#fff;
}

.top-banner {
    background-color: #B01C1C;
    background-repeat: no-repeat;
    background-size: cover;
    color: #ffffff;
    padding: 80px 0 220px 0;
    position: relative;
    z-index: 1;
}

.menu li a {
    
    font-size: 17px;
    font-weight: bold;
}

</style>



<div id="overlay" style="text-align:center">
    
       <img src="{{url('public/backend/img/santa_loader.png')}}">
    <div id="progstat"></div>
    <div id="progress"></div>
  
  </div>

 

<div class="wrapper">
	<h2 class="holidays-title">🍎Happy Christmas！🎅 AtazLearning.com</h2>
	<div class="scene">
		<div class="xmas-tree">
			<div class="tree-star">
			</div>
			<div class="tree-leaves">
				<div class="tree-part">
					<div class="tree-lights left">
						<div class="light-bulb red"></div>
						<div class="light-bulb yew"></div>
						<div class="light-bulb purple"></div>
						<div class="light-bulb blue"></div>
					</div>
					<div class="tree-lights right">
						<div class="light-bulb red"></div>
						<div class="light-bulb yew"></div>
						<div class="light-bulb purple"></div>
						<div class="light-bulb blue"></div>
					</div>
				</div>
				<div class="tree-part">
					<div class="tree-lights left">
						<div class="light-bulb red"></div>
						<div class="light-bulb yew"></div>
						<div class="light-bulb purple"></div>
						<div class="light-bulb blue"></div>
					</div>
					<div class="tree-lights right">
						<div class="light-bulb red"></div>
						<div class="light-bulb yew"></div>
						<div class="light-bulb purple"></div>
						<div class="light-bulb blue"></div>
					</div>
				</div>
				<div class="tree-part">
					<div class="tree-lights left">
						<div class="light-bulb red"></div>
						<div class="light-bulb yew"></div>
						<div class="light-bulb purple"></div>
						<div class="light-bulb blue"></div>
					</div>
					<div class="tree-lights right">
						<div class="light-bulb red"></div>
						<div class="light-bulb yew"></div>
						<div class="light-bulb purple"></div>
						<div class="light-bulb blue"></div>
					</div>
				</div>
			</div>
			<div class="tree-base">
				<div class="tree-stalk"></div>
				<div class="tree-jar"></div>
			</div>
		</div>
		<div class="room-window">
			<div class="xmas-sky">
				<div class="snow"></div>
				<div class="snow-ground"></div>
				<div class="santa-claus">
					<div class="sc-head">
						<div class="sc-hat">
							<div class="hat-tip"></div>
						</div>
						<div class="eyes"></div>
						<div class="nose"></div>
						<div class="beard"></div>
						<div class="ears">
							<div class="ear left"></div>
							<div class="ear right"></div>
						</div>
					</div>
					<div class="sc-body"></div>
				</div>
			</div>
		</div>
		<div class="xmas-gifts">
			<div class="xmas-gift square">
				<div class="tie-wrap">
					<div class="tie"></div>
					<div class="tie reflected"></div>
				</div>
			</div>
			<div class="xmas-gift rectangular">
				<div class="tie-wrap">
					<div class="tie"></div>
					<div class="tie reflected"></div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="ground"></div>
</div>
<section class="first_sec hidden">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12">
                {{--<div class="banner_right">--}}
                <div>
                    <img style="width: 38%;margin-left: 34%;" src="{{url('/public/theme1')}}/images/bulb.png">
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="banner_left">
                    <h1 style="color:#ffff">What does it mean to teach <br/>digital literacy to today's  <br/> students?</h1>
                    <div class="phone-list">

                        <div class="input-group phone-input">
            <span class="input-group-btn">
              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="type-text">91+</span> <span class=""></span></button>
           <!--    <ul class="dropdown-menu" role="menu">
                <li><a class="changeType" href="javascript:;" data-type-value="phone">Phone</a></li>
                <li><a class="changeType" href="javascript:;" data-type-value="fax">Fax</a></li>
                <li><a class="changeType" href="javascript:;" data-type-value="mobile">Mobile</a></li>
              </ul> -->
            </span>
                            <input type="hidden" name="phone[1][type]" class="type-input" value="" />
                            <input type="text" name="phone[1][number]" class="form-control" placeholder="+1 (999) 999 9999" />
                            <div class="wrapper_btn clearfix">
                                <a class="btn10" href="">Submit</a>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="get_on clearfix">
                            <span>Download Now</span>
                            {{--<span>Get it on</span>--}}
                            <ul class="clearfix">
                                {{--<li>
                                    <a href="#"><img src="{{url('/public/theme1')}}/images/iconfinder1.png"></a>
                                </li>--}}
                                <li>
                                    <a href="{{url('/atazlearning.apk')}}" download><img src="{{url('/public/theme1')}}/images/iconfinder2.png"></a>
                                </li>
                            </ul>
                        </div>
                        <div class="clearfix"></div>
                        <div class="media explor_video">
                            <div class="media-left">
                                <img src="{{url('/public/theme1')}}/images/video3.jpg">
                                <i class="fa fa-play" aria-hidden="true"></i>
                            </div>
                            <div class="media-body" style="color:#ffff">
                                <h4>See how ATAZLearning Works</h4>
                                <p>Explore the amazing world of ATAZLearning</p>
                            </div>
                        </div>
                    </div>

                    <!-- 		<div class="wrapper_btn clearfix">
                                <a class="btn10" href="">Read More</a>
                                <a class="btn10" href="">Read More</a>
                            </div> -->
                </div>

            </div>
        </div>
    </div>
</section>
<section class="second_sec">
    <div class="container">
        <div class="learn_inner">
            <h2 class="home_head"> Easy and Proper Learning </h2>
            <p class="home_para"> Education is the passport to the future, for tomorrow belongs to those who prepare for it today. </p>
            <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <div class="learn_block">
                        <div class="learn_icon">
                            <i class="fa fa-play"></i>
                        </div>
                        <h3>Video Lectures</h3>
                        <p>Visual learning is easy to understand and memorise. </p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <div class="learn_block">
                        <div class="learn_icon learn_1">
                            <i class="fa fa-pen-square"></i>
                        </div>
                        <h3>Practice</h3>
                        <p>{{ucfirst("Let's start preparing for exam with huge question bank and know your accuracy and speed.")}}</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <div class="learn_block">
                        <div class="learn_icon learn_2">
                            <i class="fa fa-file"></i>
                        </div>
                        <h3>Test Series</h3>
                        <p>{{ucfirst('Get the live  environment of entrance exams way before the actual entrance.')}}</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <div class="learn_block">
                        <div class="learn_icon learn_3">
                            <i class="fa fa-comments"></i>
                        </div>
                        <h3>Ask Doubts</h3>
                        <p>{{ucfirst('When you study well you get doubts but do you have mentor around ? Our mentors are  a click away.')}}</p>
                    </div>
                </div>

            </div>
        </div>
</section>
<section class="third_sec">
    <div class="container">
        <h2 class="home_head">Easy and Proper Learning</h2>
        <p class="home_para">Learn every concept visually for a strong foundation Learn every concept visually for a strong foundation</p>
        <div class="clases_outer">
            <div class="media">
                <div class="media-left">
                    <img src="{{url('/public/theme1')}}/images/class-11.svg">
                </div>
                <div class="media-body">
                    <h4>Class 11</h4>
                    <p>11th is the base of 12th . If you want to score good in 12th then focus on 11th .</p>
                    {{--<ul class="exams clearfix">--}}
                        {{--<li><img src="{{url('/public/theme1')}}/images/neet.png"> NEET</li>--}}
                        {{--<li><img src="{{url('/public/theme1')}}/images/neet.png"> NEET</li>--}}
                        {{--<li><img src="{{url('/public/theme1')}}/images/neet.png"> NEET</li>--}}
                    {{--</ul>--}}
                    <div class="classes_btns wrapper_btn">
                        {{--<a href="" class="btn10">Know More</a>--}}
                        <a href="{{url('class-11')}}" class="btn10">Know More</a>
                    </div>
                </div>
            </div>
            <div class="media class_12">
                <div class="media-body">
                    <h4>Class 12</h4>
                    <p>12th is your life's turning point want to succeed in your life then get good percentage in 12th. Let's start preparation.</p>
                    {{--<ul class="exams clearfix">--}}
                        {{--<li>NEET <img src="{{url('/public/theme1')}}/images/neet.png"> </li>--}}
                        {{--<li>NEET <img src="{{url('/public/theme1')}}/images/neet.png"> </li>--}}
                        {{--<li>NEET <img src="{{url('/public/theme1')}}/images/neet.png"></li>--}}
                    {{--</ul>--}}
                    <div class="classes_btns wrapper_btn">
                        {{--<a href="" class="btn10">Know More</a>--}}
                        <a href="{{url('class-12')}}" class="btn10">Know More</a>
                    </div>
                </div>
                <div class="media-right">
                    <img src="{{url('/public/theme1')}}/images/class-12.svg">
                </div>
            </div>
        </div>
    </div>
</section>
<section class="features">
    <div class="container">
        <h2 class="home_head">Features</h2>
        <p class="home_para">Get all Definitions, Formulas and Diagrams</p>
        <div class="features_inner">
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="featr_block featr_left">
                        <div class="featur_icon icon_margin">
                            <img src="{{url('/public/theme1')}}/images/Mobile-App.jpg">
                        </div>
                        <h4>Bookmarks</h4>
                        <p>The important notes on your fingerprint.</p>
                        <div class="featur_icon">
                            <img src="{{url('/public/theme1')}}/images/Mobile-App.jpg">
                        </div>
                        <h4>Accuracy</h4>
                        <p>Help you to know exactly how much %  your chapter is clear</p>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="featr_block featr_right">

                        <h4>Concepts</h4>
                        <p>Get all Definitions, Formulas and Diagrams.</p>
                        <div class="featur_icon">
                            <img src="{{url('/public/theme1')}}/images/Mobile-App.jpg">
                        </div>

                        <h4>Speed</h4>
                        <p>Help you to know your per hours question solving count .</p>
                        <div class="featur_icon">
                            <img src="{{url('/public/theme1')}}/images/Mobile-App.jpg">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@php
        $current_year = \Carbon\Carbon::now()->format('Y');
        $price = App\Modules\Price\Models\Price::where('year',$current_year)->first();
        if(!$price)
        $price = App\Modules\Price\Models\Price::first();
        @endphp
<section class="pricing_sec">
    <div class="container">
        <h2 class="home_head">Easy and Proper Learning</h2>
        <p class="home_para">Education is the passport to the future, for tomorrow belongs to those who prepare for it today.</p>
        <div class="pricing-grids">
                {{--<div class="pricing-grid2">
                <div class="price-value two">
                    <h3><a href="#">SILVER</a></h3>
                    <h5>
                        <lable style="font-size:30px"><i class="fa fa-rupee"></i><b>{{$price->silver}}</b></lable>
                    </h5>
                    <div class="sale-box two">
                        <span class="on_sale title_shop">NEW</span>
                    </div>

                </div>
                <div class="price-bg">
                    <ul>
                        <li class="whyt"><a href="#">Videos </a></li>
                        <li><a href="#">Practice</a></li>
                        --}}{{--<li><a href="#">20 Domain Names</a></li>--}}{{--
                        --}}{{--<li class="whyt"><a href="#">10 E-Mail Address </a></li>--}}{{--
                        --}}{{--<li><a href="#">100GB Monthly Bandwidth </a></li>--}}{{--
                        --}}{{--<li class="whyt"><a href="#">Fully Support</a></li>--}}{{--
                    </ul>
                    <div class="cart2" style="padding: 0.7em 0em 2.7em;">
                        <a class="popup-with-zoom-anim" href="{{url('price/details')}}">More Details</a>
                    </div>
                </div>
            </div>--}}
            <div class="pricing-grid2">
                <div class="price-value two">
                    <h3><a href="#">GOLD</a></h3>
                    {{--<h5>
                        <lable style="font-size:30px;"><i class="fa fa-rupee"></i><b>{{$price->gold}}</b></lable>
                    </h5>--}}
                 

                </div>
                <div class="price-bg">
                    <ul>
                        <li class="whyt"><a href="#">Practice </a></li>
                        <li><a href="#">Test Series</a></li>
                        {{--<li class="whyt"><a href="#">10 E-Mail Address </a></li>--}}
                        {{--<li><a href="#">100GB Monthly Bandwidth </a></li>--}}
                        {{--<li class="whyt"><a href="#">Fully Support</a></li>--}}
                    </ul>
                    <div class="cart2">
                        <a class="popup-with-zoom-anim" href="{{url('price/details')}}">More Details</a>
                    </div>
                </div>
            </div>
            <div class="pricing-grid2">
                <div class="price-value two">
                    <h3><a href="#">DIAMOND</a></h3>
                    {{--<h5>
                        <lable style="font-size:30px;"><i class="fa fa-rupee"></i><b>{{$price->diamond}}</b></lable>
                    </h5>--}}
                    <div class="sale-box two">
                        <span class="on_sale title_shop">NEW</span>
                    </div>

                </div>
                <div class="price-bg">
                    <ul>
                        <li class="whyt"><a href="#">Videos </a></li>
                        <li><a href="#">Practice</a></li>
                        <li class="whyt"><a href="#">Test Series </a></li>
                        {{--<li><a href="#">100GB Monthly Bandwidth </a></li>--}}
                        {{--<li class="whyt"><a href="#">Fully Support</a></li>--}}
                    </ul>
                    <div class="cart2">
                        <a class="popup-with-zoom-anim" href="{{url('price/details')}}">More Details</a>
                    </div>
                </div>
            </div>
            <div class="pricing-grid2">
                <div class="price-value two">
                    <h3><a href="#">PLATINUM</a></h3>
                    <h5>
                        <lable><b>{{$price->platinum}}</b></lable>
                    </h5>
                    <div class="sale-box two">
                        <!--<span class="on_sale title_shop">NEW</span>-->
                    </div>

                </div>
                <div class="price-bg">
                    <ul>
                        <li class="whyt"><a href="#">Videos </a></li>
                        <li><a href="#">Practice</a></li>
                        <li class="whyt"><a href="#">Test Series </a></li>
                        <li><a href="#">Doubts </a></li>
                        {{--<li class="whyt"><a href="#">Fully Support</a></li>--}}
                    </ul>
                    <div class="cart2">
                        <a class="popup-with-zoom-anim" href="{{url('price/details')}}">More Details</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="pricing_sec">
    <div class="container">
        <div class="pricing-grids">

            <div class="pricing-grid2" style="width:30%">
                <div class="price-value two">
                    <h3><a href="#">Happy Students</a></h3>
                    <h5>
                        <lable style="font-size:30px"><b>{{App\User::count()+10300}}</b></lable>
                    </h5>
                </div>    
            </div>
            
            
            <div class="pricing-grid2" style="width:30%">
                <div class="price-value two">
                    <h3><a href="#">Questions Attempted</a></h3>
                    <h5>
                        <lable style="font-size:30px"><b>2M+</b></lable>
                    </h5>
                </div>    
            </div>
            <div class="pricing-grid2" style="width:30%">
                <div class="price-value two">
                    <h3><a href="#">Test Attempted</a></h3>
                    <h5>
                        <lable style="font-size:30px"><b>20k+</b></lable>
                    </h5>
                </div>    
            </div>
            
        </div>
    </div>
</section>
{{--<section class="forth_sec">--}}
    {{--<div class="container">--}}
        {{--<h2 class="home_head">Easy and Proper Learning</h2>--}}
        {{--<p class="home_para">Education is the passport to the future, for tomorrow belongs to those who prepare for it today.</p>--}}
        {{--<div class="user_caroasal">--}}
            {{--<div class="owl-carousel owl-theme user_carousel">--}}
                {{--<div class="item">--}}
                    {{--<div class="user_inner">--}}
                        {{--<p><i class="fa fa-quote-left" aria-hidden="true"></i> Learn every concept visually for a strong foundation Learn every concept visually for a strong foundation <i class="fa fa-quote-right" aria-hidden="true"></i></p>--}}
                        {{--<div class="media">--}}
                            {{--<div class="media-left">--}}
                                {{--<img src="{{url('/public/theme1')}}/images/video1.jpg">--}}
                            {{--</div>--}}
                            {{--<div class="media-body">--}}
                                {{--<h4>Pranjali Singh</h4>--}}
                                {{--<p>98.7%, 10th CBSE 2018</p>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="item">--}}
                    {{--<div class="user_inner">--}}
                        {{--<p><i class="fa fa-quote-left" aria-hidden="true"></i> every concept visually for a strong foundation Learn every concept visually for a strong foundation <i class="fa fa-quote-right" aria-hidden="true"></i></p>--}}
                        {{--<div class="media">--}}
                            {{--<div class="media-left">--}}
                                {{--<img src="{{url('/public/theme1')}}/images/video1.jpg">--}}
                            {{--</div>--}}
                            {{--<div class="media-body">--}}
                                {{--<h4>Pranjali Singh</h4>--}}
                                {{--<p>98.7%, 10th CBSE 2018</p>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="item">--}}
                    {{--<div class="user_inner">--}}
                        {{--<p><i class="fa fa-quote-left" aria-hidden="true"></i>  Learn every concept visually for a strong foundation Learn every concept visually for a strong foundation <i class="fa fa-quote-right" aria-hidden="true"></i></p>--}}
                        {{--<div class="media">--}}
                            {{--<div class="media-left">--}}
                                {{--<img src="{{url('/public/theme1')}}/images/video1.jpg">--}}
                            {{--</div>--}}
                            {{--<div class="media-body">--}}
                                {{--<h4>Pranjali Singh</h4>--}}
                                {{--<p>98.7%, 10th CBSE 2018</p>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="item">--}}
                    {{--<div class="user_inner">--}}
                        {{--<p><i class="fa fa-quote-left" aria-hidden="true"></i>  Learn every concept visually for a strong foundation Learn every concept visually for a strong foundation <i class="fa fa-quote-right" aria-hidden="true"></i></p>--}}
                        {{--<div class="media">--}}
                            {{--<div class="media-left">--}}
                                {{--<img src="{{url('/public/theme1')}}/images/video1.jpg">--}}
                            {{--</div>--}}
                            {{--<div class="media-body">--}}
                                {{--<h4>Pranjali Singh</h4>--}}
                                {{--<p>98.7%, 10th CBSE 2018</p>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="item">--}}
                    {{--<div class="user_inner">--}}
                        {{--<p><i class="fa fa-quote-left" aria-hidden="true"></i>  Learn every concept visually for a strong foundation Learn every concept visually for a strong foundation <i class="fa fa-quote-right" aria-hidden="true"></i></p>--}}
                        {{--<div class="media">--}}
                            {{--<div class="media-left">--}}
                                {{--<img src="{{url('/public/theme1')}}/images/video1.jpg">--}}
                            {{--</div>--}}
                            {{--<div class="media-body">--}}
                                {{--<h4>Pranjali Singh</h4>--}}
                                {{--<p>98.7%, 10th CBSE 2018</p>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</section>--}}

<div class="modal fade in" data-backdrop="static"  data-keyboard="false" id="login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h2>ATAZ Learning</h2>
            </div>
            <div class="modal-body clearfix">
                @if(Session::has('success'))
                    <div class="alert alert-success alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Success!</strong> Your account has been created successfully.
                    </div>
                    @php
                        Session::forget('success');
                        Session::save();
                    @endphp
                @endif

                    @if(Session::has('expired'))
                        <div class="alert alert-danger alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                Opps Your account has been expired.
                        </div>
                    @endif
                <div class="login_cartoon">
                    <img src="{{url('public/theme1/images/clipart-happy-pencil.jpg')}}">
                </div>
                <div class="login-page">
                    <div class="form">
                        <form @if(Session::has('register')) style='display:block;' @endif class="register-form" method="POST" action="{{ route('register') }}" onsubmit="return phonenumber(this);">
                            <h4>Sign Up</h4>
                            {{ csrf_field() }}
                            <input type="text" id="reg-mobile" onblur="phonenumber()" name="mobile" value="{{ old('mobile') }}" placeholder="Mobile Number"/>
                            <span class="help-block err-mobile-number" style="display:none">
                                        <strong>Please enter valid mobile number.</strong>
                                    </span>
                            @if ($errors->has('mobile'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('mobile') }}</strong>
                                    </span>
                            @endif
                            <input type="text" name="name" value="{{ old('name') }}" required placeholder="Enter Your Name"/>
                            @if ($errors->has('name'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                            @endif



                            <input id="password" type="password" placeholder="Password" name="password" required>
                            @if ($errors->has('password'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif

                            <input id="password-confirm" type="password" placeholder="Confirm Password" name="password_confirmation" required>
                            <button type="submit">Register</button>
                            <p class="message">Already registered? <a href="#">Sign In</a></p>
                        </form>

                        <form @if(Session::has('register')) style='display:none;' @endif class="login-form" method="POST" action="{{ route('login') }}">
                            {{ csrf_field() }}
                            <h4>Login</h4>
                            <input id="mobile" type="text" placeholder="Mobile Number" name="mobile" value="{{ old('mobile') }}" required autofocus/>
                            @if ($errors->has('mobile'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('mobile') }}</strong>
                                    </span>
                            @endif
                            <input id="password" type="password"  name="password" required placeholder="Password"/>

                            @if ($errors->has('password'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif


                            <button type="submit" >
                                Login
                            </button>
                            <br>
                            <br>
                            <p class="">Forgot Password ? <a id="forgot_password_link" href="javascript:void(0);">Click here</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer')


<script type="text/javascript">

    $(function () {
            @if(Session::has('expired'))
            $('#login').modal('show');
            @endif

            @if(Session::has('errors'))
            $('#login').modal('show');
        @endif
    });


    jQuery('.class_inner').click(function(){
        jQuery(this).toggleClass('selected_c');
    });
    $(document).ready(function(){
        var touch   = $('#resp-menu');
        var menu  = $('.menu');

        $(touch).on('click', function(e) {
            e.preventDefault();
            menu.slideToggle();
        });

        $(window).resize(function(){
            var w = $(window).width();
            if(w > 767 && menu.is(':hidden')) {
                menu.removeAttr('style');
            }
        });
        $('body').append('<div id="toTop" class="btn btn-info"><i class="fa fa-angle-up" aria-hidden="true"></i></div>');
        $(window).scroll(function () {
            if ($(this).scrollTop() != 0) {
                $('#toTop').fadeIn();
            } else {
                $('#toTop').fadeOut();
            }
        });
        $('#toTop').click(function(){
            $("html, body").animate({ scrollTop: 0 }, 600);
            return false;
        });

    });
    
    ;(function(){
  function id(v){ return document.getElementById(v); }
  function loadbar() {
    var ovrl = id("overlay"),
        prog = id("progress"),
        stat = id("progstat"),
        img = document.images,
        c = 0,
        tot = img.length;
    if(tot == 0) return doneLoading();

    function imgLoaded(){
      c += 1;
      var perc = ((100/tot*c) << 0) +"%";
      prog.style.width = perc;
      stat.innerHTML = "Loading "+ perc;
      if(c===tot) return doneLoading();
    }
    function doneLoading(){
      ovrl.style.opacity = 0;
      setTimeout(function(){ 
        ovrl.style.display = "none";
      }, 3000);
    }
    for(var i=0; i<tot; i++) {
      var tImg     = new Image();
      tImg.onload  = imgLoaded;
      tImg.onerror = imgLoaded;
      tImg.src     = img[i].src;
    }    
  }
  document.addEventListener('DOMContentLoaded', loadbar, false);
}());
</script>
@endsection