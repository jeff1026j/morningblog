(function($) {
	
	$(document).ready(function($){
		
		// Hide Custom Url if image link is not set to custom url
		$('body').on('change', '.jr-container select[id$="images_link"]', function(e){
			var images_link = $(this);
			if ( images_link.val() != 'custom_url' ) {
				images_link.closest('.jr-container').find('input[id$="custom_url"]').val('').parent().animate({opacity: 'hide' , height: 'hide'}, 200);
			} else {
				images_link.closest('.jr-container').find('input[id$="custom_url"]').parent().animate({opacity: 'show' , height: 'show'}, 200);
			}
		});

		// Hide Refresh hour if source is wp media library
		$('body').on('change', '.jr-container select[id$="template"]', function(e){
			var template = $(this);
			if ( template.val() == 'thumbs' ) {
				template.closest('.jr-container').find('.jr-slider-options').animate({opacity: 'hide' , height: 'hide'}, 200);
				template.closest('.jr-container').find('input[id$="columns"]').closest('p').animate({opacity: 'show' , height: 'show'}, 200);
			} else {
				template.closest('.jr-container').find('.jr-slider-options').animate({opacity: 'show' , height: 'show'}, 200);
				template.closest('.jr-container').find('input[id$="columns"]').closest('p').animate({opacity: 'hide' , height: 'hide'}, 200);
			}
		});


		// Hide Refresh hour if source is wp media library
		$('body').on('change', '.jr-container input:radio[id$="source"]', function(e){
			var source = $(this);
			if ( source.val() != 'instagram' ) {
				source.closest('.jr-container').find('input[id$="refresh_hour"]').closest('p').animate({opacity: 'hide' , height: 'hide'}, 200);
				source.closest('.jr-container').find('input[id$="attachment"]').closest('p').animate({opacity: 'hide' , height: 'hide'}, 200);
				source.closest('.jr-container').find('.blocked-wrap').animate({opacity: 'hide' , height: 'hide'}, 200);
			} else {
				source.closest('.jr-container').find('input[id$="refresh_hour"]').closest('p').animate({opacity: 'show' , height: 'show'}, 200);
				source.closest('.jr-container').find('input[id$="attachment"]').closest('p').animate({opacity: 'show' , height: 'show'}, 200);
				source.closest('.jr-container').find('.blocked-wrap').animate({opacity: 'show' , height: 'show'}, 200);
			}
		});		
		
		// Hide blocked images if not checked attachments
		$('body').on('change', '.jr-container [id$="attachment"]:checkbox', function(e){
			var attachment = $(this);
			if ( this.checked ) {
				attachment.closest('.jr-container').find('.blocked-wrap').animate({opacity: 'show' , height: 'show'}, 200);
			} else {
				attachment.closest('.jr-container').find('.blocked-wrap').animate({opacity: 'hide' , height: 'hide'}, 200);
			}
		});

		// Toggle advanced options
		$('body').on('click', '.jr-advanced', function(e){
			e.preventDefault();
			var advanced_container = $(this).parent().next();
			
			if ( advanced_container.is(':hidden') ) {
				$(this).html('[ - Close ]');
			} else {
				$(this).html('[ + Open ]');
			}
			advanced_container.toggle();
		});

		// Toggle blocked images
		$('body').on('click', '.blocked-images-toggle', function(e){
			e.preventDefault();
			var blocked_container = $(this).next();
			
			if ( blocked_container.is(':hidden') ) {
				$(this).html('[ - Close ]');
			} else {
				$(this).html('[ + Open ]');
			}
			blocked_container.toggle();
		});		
		
		// Remove blocked images with ajax
		$('body').on('click', '.jr-container .blocked-images .blocked-column', function(e){
			var li = $(this),
				id = li.data('id'),
				username  = li.closest('.jr-container').find('input[id$="username"]').val(),
				counter   = li.closest('.jr-container').find('.blocked-count-nr'),
				ajaxNonce = li.closest('.jr-container').find('input[name=unblock_images_nonce]').val();
			
			$.ajax({
				type: 'POST',
				url: ajaxurl,
				data: {
					action: 'jr_unblock_images',
					username : username,
					id : id,
					_ajax_nonce: ajaxNonce
				},
				success: function(data, textStatus, XMLHttpRequest) {
					if ( data == 'success' ) {
						li.fadeOut( "slow", function() {
							$(this).remove();	
							counter.html(parseInt(counter.html(), 10) - 1);
						});
					}
				},
				error: function(XMLHttpRequest, textStatus, errorThrown) {
					//console.log(XMLHttpRequest.responseText);
				}
			});
		});

	}); // Document Ready

})(jQuery);