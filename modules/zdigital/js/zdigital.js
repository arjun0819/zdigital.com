/**
 * 
 */
(function($){

	Drupal.addVideoSource = function(dom){
		var id = $('input[type=text]', $(dom).parent()).attr('id');
		
		window.open(Drupal.settings.basePath+'imce?app=video'+Drupal.encodePath('|')+'url'+Drupal.encodePath('@')+id, '', 'toolbar=no,width=800');
	}
	
	Drupal.behaviors.addProgramacion = {
		attach: function(context, settings){

			jQuery('#edit-field-name, #edit-field-brief-introduction').remove();
			
			if(typeof $.fn.datepicker != 'undefined') {
				$("input[type=text][name^='field_post_date']").attr('size', '10').datepicker();
			}
		}
	};
})(jQuery)