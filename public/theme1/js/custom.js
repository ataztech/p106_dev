$(document).ready(function() {
  /*var $header = $("header"),
      $clone = $header.before($header.clone().addClass("clone"));*/
      $('.exm_outr .media').click(function(){
//        $(this).toggleClass('exm_clicked');
      });
      $('.message a').click(function(){
         $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
      });
  $(window).bind("load", function() {
      var footer = $("#Footer_Main");
      var pos = footer.position();
      var height = $(window).height();
       height = height - pos.top;
       height = height - footer.height();
       if (height > 0) {
        footer.css({'margin-top' : height+'px'});
    }
  });

   if (screen.width >= 768){
            var e = window.innerHeight;
             $(".banner-sec").css("height", e + "px");
   }

 $('.video_slider1').owlCarousel({
    loop:true,
    margin:10,
    nav:true,
    smartSpeed :900,
    navText : ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
    responsive:{
        0:{
            items:1
        },
        600:{
            items:1
        },
        1000:{
            items:4
        }
    }
})
  $('.video_slider2').owlCarousel({
    loop:true,
    margin:10,
    nav:true,
    smartSpeed :900,
    navText : ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
    responsive:{
        0:{
            items:1
        },
        600:{
            items:1
        },
        1000:{
            items:4
        }
    }
})
});

$(window).on("scroll", function() {
  $('body').removeClass("down");
  var fromTop = $("body").scrollTop();
  $('body').addClass("down", (fromTop > 180));
});

