$(function(){
	var open = true;
	var windowSize = $(window)[0].innerWidth;
	var targetSizeMenu = (windowSize <= 400) ? 200 : 300;
	if (windowSize <= 760) {
		$('aside').css('width', '0').css('padding', '0');
		open = false;
	}
	$('.menu-btn').click(function(){
		if (open) {

			$('aside').animate({'width':0, 'padding':0}, function(){
				open = false;
			});
			$('.content,header').css('width','100%');
			$('.content, header').animate({'left':0}, function(){
				open = false;
			});
		

		}else{
			$('aside').css('display', 'block');

			$('aside').animate({'width':targetSizeMenu+'px', 'padding':'10px'}, function(){
				open = true;
			});
			$('.content,header').css('width','calc(100% - 300px)');
			$('.content, header').animate({'left':targetSizeMenu+'px'}, function(){
				open = true;
			});

		}
	})
})