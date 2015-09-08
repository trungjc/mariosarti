$(function() {
	$('.loadcontenttoowong').load('ajax.php?s=toowong');
	$('.loadcontentbardon').load('ajax.php?s=bardon');
	$('.loadcontenttoowongs').load('ajax.php?s=toowongs');
	$('.loadcontentbardons').load('ajax.php?s=bardons');
});
$('.menu .item').live('mouseover', function() {
	var _class = jQuery(this).attr('class').split(" "),
		_c = _class[0];
	$('.menu .item').removeClass('active');
	$(this).addClass('active');
	if(_c == 'toowong-item') {
		$('.inner').removeClass('innerb');
		$('#b').hide();
		$('#t').fadeIn(500);
		$(this).parents('.inner').addClass('innert');
	}
	else {
		$('.inner').removeClass('innert');
		$('#t').hide();
		$('#b').fadeIn(500);
		$(this).parents('.inner').addClass('innerb');
	}
});


/*$(document).ready(function(){	
	
	$('footer').animate({"bottom":0}, 500);
	$('header').animate({"top":0}, 800, function() {
		$('#wrapper').fadeIn(1000);
	});
	
	$(".main-menu").fadeIn(3000,function() {
		$('.toowong-item').show("slide", { direction: "left" }, 700,function() {
			$(".bardon-item").show("slide", { direction: "right" }, 700,function(){
				//$('html,body').animate({scrollTop: 580}, 900);					
				//$(".event-area,.copyright").slideDown(1000);
			});						
	});	
	});
		
	$('.toowong-item').hover(function(){	
		$(this).parents('.inner').removeClass('innerb')
		$('.item').removeClass('active');
		$(this).parents('.inner').addClass('innert')
		$(this).addClass('active')
		$('#b').hide(); //css("display","none");		
		$('#t').fadeIn(700);
	}).click(function(){
			window.location.href='http://109.123.101.33/~mariosa/toowong/';
		});
	
	$('.bardon-item').hover(function(){		
		$(this).parents('.inner').removeClass('innert')
		$('.item').removeClass('active');
		$(this).parents('.inner').addClass('innerb')
		$(this).addClass('active')
		$('#t').hide(); //css("display","none");		
		$('#b').fadeIn(700);
	}).click(function(){
			window.location.href='http://109.123.101.33/~mariosa/bardon/';
		});
})

function splashRotator(){
	var cur = $('#jSplash').children('.selected');
	var next = $(cur).next();
	
	if($(next).length != 0) {
		$(next).addClass('selected');
	} else {
		$('#jSplash').children('section:first-child').addClass('selected');
		next = $('#jSplash').children('section:first-child');
	}
		
	$(cur).removeClass('selected').fadeOut(800, function() {
		$(next).fadeIn(800);
	});
}

*/