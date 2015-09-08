/*-------------------------------------------------------------------------

	Theme Name: EGO
	
	For any questions concerning this theme please refer to documention or
	our forum at support.udfrance.com.

/*------------------------------------------------------------------------

//GENERAL FUNCTONS ///////////////////////////////////////////////////////

-------------------------------------------------------------------------*/
var isMobile = false; //initiate as false
// device detection
if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent) 
    || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0,4))) isMobile = true;
jQuery(document).ready(function($){
	/*vars used throughout*/
	var wh,
		scrollSpeed = parseInt(udt_global_vars.scroll_speed,10),
		parallaxSpeedFactor = 0.6,
		scrollEase = 'easeOutExpo',
		targetSection,
		sectionLink = 'a.navigateTo',
		menuLinkStr = '.menu ul li a',
		menuLink = $('.menu ul li a'),
		section = $('.section'),
		toggleMenu =$('.mobileMenuToggle'),
		foliothumb = $('.folio-thumb'),
		thumbW,
		thumbH,
		thumbCaption,
		target,
		hoverSpeed=500,
		hoverEase='easeOutExpo';


	//INIT --------------------------------------------------------------------------------/
	
	
	if(isMobile === true) {
		$('.header').addClass('mobileHeader');	//add mobile header class	
	} else {
		$('.section').addClass('desktop');
		$('.teaser').addClass('fixed-desktop');
	}
	
	//HOMEPAGE SPECIFIC -----------------------------------------------------------------/
	
	function sliderHeight(){
		wh = $(window).height();
		$('#homepage').css({height:wh});
	}
	
	sliderHeight();
	$('#wrapper, #footer').show();

	var lH = $('.epic-logo').height();
	var	lW = $('.epic-logo').width();
	$('.epic-logo').css({marginTop:-(lH/2),marginLeft:-(lW/2)});
	$('.epic-logo').hover(function() {
		if(isMobile === true) {
			return false;
		}
		$(this).animate({width:lH+50,height:lW+50,marginLeft:-((lH+50)/2),marginTop:-((lW+50)/2)},{queue:false});
	},
	function() {
		if(isMobile === true) {
			return false;
		}
		$(this).animate({width:lH,height:lW,marginLeft:-lH/2,marginTop:-lW/2},{queue:false});
	});

	//PARALLAX ----------------------------------------------------------------------------/
		
	$(window).bind('load', function() {
		parallaxInit();
	});
	
	function parallaxInit(){
		if(isMobile === true) {
			return false;
		}
		$('.teaser').each(function() {
			$(this).parallax();
		});
		/*add as necessary*/
	}

	//PAGE SPECIFIC ---------------------------------------------------------------------/
	
	/*page scrolling
	-------------------*/
	
	$(document).on('click', '.epicSlider .epic-logo a', function(event) {
		//kill slider timer
		$.fn.epicSlider.killTimer();
		
		//get current
		targetSection = $(this).attr('href').split("#")[1];
		if(!targetSection || targetSection=='') {
			return;
		}
		targetSection = '#'+targetSection;
		
		//get pos of target section
		var targetOffset = Math.floor($(targetSection).offset().top+1);
		
		//scroll			 
		$('html,body').animate({scrollTop: targetOffset}, scrollSpeed, scrollEase, function() {
			/*ios5 menu fix*/
			if(iOS5===true) {
				$('.header.mobileHeader').animate({position:'absolute',top:$(window).scrollTop()},1);
			}
		});
		
		return false;
		//event.preventDefault();
		
	});
		
	$(document).on('click', sectionLink+','+menuLinkStr, function(event) { 
	
		//kill slider timer
		$.fn.epicSlider.killTimer();
		
		//get current
		targetSection = $(this).attr('href').split("#")[1];
		if(!targetSection || targetSection=='') {
			return;
		}
		targetSection = '#'+targetSection;
		
		//get pos of target section
		var targetOffset = Math.floor($(targetSection).offset().top+1);
		
		//scroll			 
		$('html,body').animate({scrollTop: targetOffset}, scrollSpeed, scrollEase, function() {
		
			/*ios5 menu fix*/
			if(iOS5===true) {
				$('.header.mobileHeader').animate({position:'absolute',top:$(window).scrollTop()},1);
			}
		});
		
		return false;
		
	});

	/*nav handling
	-------------------*/
	$(function(){
		section.waypoint({
			handler: function(event, direction) {
				var activeSection = $(this);
				
				if (direction === "up") {
					activeSection = activeSection.prev();
				}
				
				var activeMenuLink = $('.menu ul li a[href$=#' + activeSection.attr('id') + ']');
				
				menuLink.parent('li').removeClass('current_page_item current-menu-item');
				activeMenuLink.parent('li').addClass('current_page_item current-menu-item');
			},
			offset: '35%'	//when it should switch on consecutive page
		});
	});
	
	/*nav reveal
	-------------------*/
	$(window).bind('scroll', function(){
		if(isMobile === false){
			desktopMenu();
		} else {
			mobileMenu();
		}
	}); 
	
	//desktop menu
	function desktopMenu(){
		//reveal 
		if ($(window).scrollTop() >= wh){
			if(!$('.header-main').is(':animated')) {
				$('.header-main').stop(true,true).fadeIn();
				/*push elements out of view when scrolling*/
				if(isMobile !== true) {
					$('.epic-graphic, .epic-caption,#epic-navigation').css({position:'absolute'});
				}
			}
		} else {
			if(!$('.header-main').is(':animated')) {
				$('.header-main').stop(true,true).fadeOut();
				if(isMobile !== true) {
					$('.epic-graphic, .epic-caption,#epic-navigation').css({position:'fixed'});
				}
			}
		}
	}
	
	//mobile menu
	function mobileMenu(){
		//reveal 
		if ($(window).scrollTop() <= wh) {
			$('.header-main').hide();
		} else {
			$('.header-main').show();
		}
		$('.header').css({top:'0px'});
		$('.header.mobileHeader').css({position:'fixed'});
	}
	
	//ROLLOVER SPECIFIC ---------------------------------------------------------------------/
	/*folio
	-------------------*/
	foliothumb.on({
		mouseenter: function () {
			//check if device is mobile 
			//or within an inactive filter category
			//or if its video content in which case do nothing
			if(isMobile === true) {
				return false;
			}
			
			thumbW = foliothumb.find('a').find('img').width();
			thumbH = foliothumb.find('a').find('img').height();
			
			//get refrences needed
			thumbCaption = $(this).find('a').attr('title');
			
			//add rolloverscreen
			if(!$(this).find('a').find('div').hasClass('folio-thumb-rollover')) {
				$(this).find('a').append('<div class="folio-thumb-rollover"></div>');
			}
			
			//set it to the image size and fade in
			var hoverScreen = $('.folio-thumb-rollover');
			hoverScreen.css({width:thumbW,height:thumbH});
			
			//make sure caption is filled out
			if (typeof thumbCaption !== 'undefined' && thumbCaption !== false && $(this).find(hoverScreen).is(':empty')) {	
				//construct rollover & animate
				$(this).find(hoverScreen).append('<div class="thumbInfo">'+thumbCaption+'</div>');
				target = $(this).find(hoverScreen);
				target.stop().animate({opacity:1},hoverSpeed, hoverEase);
			}
		},
		mouseleave: function () {
			if(isMobile === true) {
				return false;
			}
			//animate out
			$(this).find('.folio-thumb-rollover').animate({opacity:0},hoverSpeed,'linear',function(){
				//delete rollover
				$(this).remove();
			});
		}
	});
	
	//WINDOW EVENTS ---------------------------------------------------------------------/
	$(window).bind('resize',function() {
		//Update slider height
		sliderHeight();
	});
});