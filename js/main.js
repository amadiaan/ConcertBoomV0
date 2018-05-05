//navbar-toggle x icon....

$(document).ready(function () {
			  $(".navbar-toggler").on("click", function () {
				    $(this).toggleClass("active");
			  });
		});



jQuery(document).ready(function($) {
	$('.search-box').hide();
	$('#searhbutton').click(function(event) {
		$('.search-box').slideToggle();
	});
});




$('#artists-carousel,#artists-carousel2').owlCarousel({
    margin:10,
    responsiveClass:true,
    autoplay : true,
   	autoplayTimeout : 4000,
    navText: ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
    responsive:{
        0:{
            items:1,
            nav:true
        },
        600:{
            items:3,
            nav:true
        },
        1000:{
            items:5,
            nav:true,
            loop:false

           
        }
    }

})


$('#featured-carousel').owlCarousel({
    margin:10,
    responsiveClass:true,
    autoplay : true,
   	autoplayTimeout : 4000,
    navText: ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
    responsive:{
        0:{
            items:1,
            nav:true,
            loop:true
        },
        600:{
            items:3,
            nav:true
        },
        1000:{
            items:3,
            nav:true,
            loop:false

           
        }
    }

})



var OSName="Unknown OS";
if (navigator.appVersion.indexOf("Win")!=-1) OSName="Windows";
if (navigator.appVersion.indexOf("Mac")!=-1) OSName="MacOS";
if (navigator.appVersion.indexOf("X11")!=-1) OSName="UNIX";
if (navigator.appVersion.indexOf("Linux")!=-1) OSName="Linux";

console.log('Your OS: '+OSName);

if (navigator.appVersion.indexOf("Win")!=-1) 
{
  $('.citypage .similarartist-section hr.boldline').css('margin-top','28px');
} else {
  $('.citypage .similarartist-section hr.boldline').css('margin-top','14px'); // this will style body for other OS (Linux/Mac)
}