$(function(){


	$('nav.mobile').click(function(){
		var listaMenu = $('nav.mobile ul');
		
		if (listaMenu.is(':hidden')==true){ 
			var icone = $('.botao-menu-mobile').find('i');
			icone.removeClass('fa-bars');
			icone.addClass('fa-xmark');
			listaMenu.slideToggle();
		}else{
			var icone = $('.botao-menu-mobile').find('i');
			icone.addClass('fa-bars');
			icone.removeClass('fa-xmark');
			listaMenu.slideToggle();
			
		}
		
	});

	if ($('target').length > 0) {

		var elemento = '#'+$('target').attr('target');
		var divScroll = $(elemento).offset().top;
		$('html,body').animate({'scrollTop':divScroll});
		
	}

	carregamentoDinamico();
	function carregamentoDinamico() {
		$('[realtime]').click(function() {
			var pagina = $(this).attr('realtime');
			$('.container-principal').hide();
			$('.container-principal').load(include_path+'/pages/'+pagina+'.php');

			$('.container-principal').fadeIn(2000);
			return false;
		})
	}
})