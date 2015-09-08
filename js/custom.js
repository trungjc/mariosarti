$(document).ready(function(){	
	$(".main-menu").fadeIn(3000,function() {
			$('.toowong-item').show("slide", { direction: "left" }, 700,function() {
					$(".bardon-item").show("slide", { direction: "right" }, 700,function(){
						$('html,body').animate({scrollTop: 580}, 900);					
						$(".event-area,.copyright").slideDown(1000);
					});						
			});	
	});	
	$('.toowong-item').hover(function(){	
		$(this).parents('.inner').removeClass('innerb')
		$('.item').removeClass('active');
		$(this).parents('.inner').addClass('innert')
		$(this).addClass('active')
		$('#b').css("display","none");		
		$('#t').fadeIn(1000);
	},function(){})
	
	$('.bardon-item').hover(function(){		
		$(this).parents('.inner').removeClass('innert')
		$('.item').removeClass('active');
		$(this).parents('.inner').addClass('innerb')
		$(this).addClass('active')
		$('#t').css("display","none");		
		$('#b').fadeIn(1000);
	},function(){})
})