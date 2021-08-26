jQuery(document).ready(function($){
	$('#jstree').jstree({
		'core': {
			'themes': {
				'variant': 'large'
			}
		},
		'checkbox': {
			'keep_selected_style': false
		},
		'plugins': [ 'wholerow', 'checkbox' ]
	});

	$('.convert-all-images, .convert-missing-images').click(function(event){
		event.preventDefault();
		window.selected_folders = $('#jstree').jstree().get_checked();
		if( selected_folders.length ){
			$('#transparency_status_message span').text( transparency_status_message );
			$('#transparency_status_message').show();
			$('#hide-on-convert').hide();
			convert_old_images( $(this).hasClass('convert-missing-images') ? 1 : 0 );
		}
	});

	function convert_old_images( only_missing, folder ){
		if( selected_folders.length || folder ){
			var folder = folder || selected_folders.shift();
			$('#show-on-convert').prepend('<div>/' + folder + '/ ... </div>');
			$.ajax({
				type: 'POST',
				url: ajaxurl,
				data: {
					action: 'convert_old_images',
					only_missing: only_missing,
					folder: folder
				}
			})
			.done(function( response, statusText, xhr ){
				$('#show-on-convert div').first().append( response );
				convert_old_images( only_missing );
			})
			.fail(function( xhr, textStatus ){
				$('#show-on-convert div').first().append( error_message.replace( '{{ERROR}}', xhr.status ) );
				convert_old_images( 1, folder );
			});
		}else{
			$('#transparency_status_message').hide();
			$('#show-on-convert').prepend('<div>DONE.</div>');
		}
	}
});