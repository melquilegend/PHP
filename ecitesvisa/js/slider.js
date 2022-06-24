$(function () {
 var curSlider = 0;
 var maxSlider = $('.banner-single').length - 1;
 var delay = 3;

 changeSlider();
 initSlider();

 function initSlider() {
 	$('.banner-single').hide();
 	$('.banner-single').eq(0).show();
 	for (var i = 0; i < maxSlider + 1; i++) {
 		var content = $('.bullets').html();
 		if (i == 0) 
 		content+='<span class="active-slider"></span>';
 		else
 		content+='<span></span>';
 		$('.bullets').html(content);
 	}
 }
 function changeSlider() {
 	setInterval(function () {
 		$('.banner-single').eq(curSlider).stop().fadeOut(4000);
 		curSlider++;
 		if (curSlider > maxSlider) 
 			curSlider = 0;
 		$('.banner-single').eq(curSlider).stop().fadeIn(4000);

 		$('.bullets span').removeClass('active-slider');
 		$('.bullets span').eq(curSlider).addClass('active-slider');

 	}, delay * 1000);
 }
 $('body').on('click', '.bullets span', function() {
 	var currentBullet = $(this);
 	$('.banner-single').eq(curSlider).stop().fadeOut(1000);
 	curSlider = currentBullet.index();
 	$('.banner-single').eq(curSlider).stop().fadeIn(1000);
 	$('.bullets span').removeClass('active-slider');
 	currentBullet.addClass('active-slider');
 })
})