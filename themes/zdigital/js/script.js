/**
 * 
 */
(function($){
	$(function(){
		$("#sideshow").aj_slideshow();
		
		$("#header #menu a").hover(function(){
			
			var self = this;
			var parent = $(this).parent().parent().parent();
			$('a.active', parent).removeClass('active').addClass('active-bak');
		}, function(){
			var parent = $(this).parent().parent().parent();
			$('a.active-bak', parent).addClass('active').removeClass('active-bak');
		});
		
		$('#search-block-form input.form-text').attr('placeholder', Drupal.t('Busca'));
//		if($('#search-block-form input.form-text').val()){
//			$('#search-block-form input.form-text').css({width: '160px'});
//		}else{
//			$('#search-block-form input.form-text').css({width: '100px', marginLeft: '60px'});
//		}
//		$('#search-block-form input.form-text').focus(function(){
//			$('#search-block-form input.form-text').css({width: '160px', marginLeft: '0px'});
//		}).blur(function(){
//			if($(this).val() == ''){
//				$('#search-block-form input.form-text').css({width: '100px', marginLeft: '60px'});
//			}
//		});
		
		if(typeof $('#menu a.active')[0] == 'undefined') {
			$('#header a[href="'+window.location.pathname+'"]').addClass('active');
		}
		// dynamic response
		
		$(".menu-trigger").on('click', function(e){
			e.preventDefault();
			var id = $(this).attr('href');
			$(".tab-content .tab-pane").hide();
			if($(id).is(":visible")) {
				$(id).hide(1000);
			}else{
				$(id).show(1000);
			}
		});
		
		
		// popover 
		$(".popover-toggle").each(function(){
			var trigger = $(this).attr('data-trigger') || 'click';
			var placement = $(this).attr('data-placement') || ($(this).offset().left > $(document).width()/2 ? 'left' : 'right');
			var option = {
				'html': true,
				'content': $('.popover', $(this).parent()).html(),
				'placement': placement,
				'trigger': 'hover',
				'container': 'body'
			};
			
			$(this).popover(option).on('show.bs.popover', function(){
				$('.popover').removeClass('in');
			});
		});
		$("form.contact-form").addClass('row');
		$("form.contact-form .form-type-checkbox,form.contact-form .form-actions").addClass('clearfix col-xs-12 ');
		$("form.contact-form .form-type-textarea").addClass('clearfix col-xs-8');
		$("form.contact-form .form-type-textarea textarea").addClass('form-control');
		$("form.contact-form .form-type-textfield").addClass('col-md-4 col-xs-12 clearfix');

	    var iOS = false, p = navigator.platform;
	    var ua = navigator.userAgent.toLowerCase();
	    
		if( p === 'iPad' || p === 'iPhone' || p === 'iPod' || ua.indexOf("android") > -1){
		    iOS = true;
		}
		if(iOS) {
		  jQuery(".hidden-ipad, .hidden-iphone").hide();
		  jQuery(".show-ipad, .show-iphone").show();
		}else{
		  jQuery(".hidden-ipad, .hidden-iphone").show();
		  jQuery(".show-ipad, .show-iphone").hide();
		}
		
		$('body').append('<div id="modal" class="modal fade bs-example-modal-lg"><div class="modal-dialog modal-md"><div class="modal-content">'
			  +'<div class="modal-header">'
		      +'<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>'
		      +'<h4 class="modal-title" id="myModalLabel">Modal title</h4>'
		      +'</div>'
		      +'<div class="modal-body"></div>'
			  +'</div></div></div>');
		//@todo
		$("#second-menu .account a").bind("click", function(e){
			e.preventDefault();
			var url = $(this).attr('href');
			$.ajax({
				url: url,
				type: "post",
				dataType: 'json',
				success: function(response){
					var output = response.data;
					$("body > #modal .modal-content .modal-title").html(response.title);
					$("body > #modal .modal-content .modal-body").html(output);
					
					$('#modal').modal("show");
				}
			})
		})
	});
})(jQuery);

Drupal.validateRegisterForm = function (frm) {
    var phone = jQuery('input[type=text][name^=field_phone]').val();
    
    if(!(phone.match(/[0-9]{10}/i))){
        alert("Phone number format is incorrect.");
        jQuery('input[type=text][name^=field_phone]').addClass('error');
        return false;
    }
    
    return true;
};