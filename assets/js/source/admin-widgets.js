/*
** Scripts for widgets admin page.
*/

jQuery( document ).ready( function ( $ ) {

	function mediaUploader( buttonClass ) {

		// Trigger the Media Uploader dialog.
		$( document ).on( 'click', buttonClass, function( e ) {

			var mediaUploader;
				form = $( buttonClass ).closest( 'form' )

			// If the uploader object has already been created, reopen the dialog.
			if ( mediaUploader ) {
				mediaUploader.open();
				return;
			}

			 // Extend the wp.media object.
			var mediaUploader = wp.media.frames.file_frame = wp.media( {
				title: 'Select Image',
				button: {
					text: 'Select Image'
				},
				multiple: false,
				library: {
					type: 'image'
				},
			} );

			// When a file is selected, grab the URL and set it as the text field's value.
			mediaUploader.on( 'select', function () {
				var attachment = mediaUploader.state().get( 'selection' ).first().toJSON();

				form.find( '.image-upload' ).val( attachment.url );
				form.find( '.media-image-container' ).empty();
				form.find( '.media-image-container' ).append( '<img src="' + attachment.url + '" class="media-image" alt="Image Preview" style="max-width:100%;margin-bottom:10px" />' );

				$( '.media-modal:visible' ).find( '.media-modal-close' ).trigger( 'click' );
			} );

			// Open the uploader dialog.
			mediaUploader.open();
		} );
	}

	// Initialize media uploader.
	mediaUploader( '.button-add-adv-media' );

	$( '.sortable-list' ).sortable( {
		update: function( event, ui ) {
			var items = [];
			$( this ).find( 'li.visible' ).each( function() {
				items.push( $( this ).data( 'key' ).trim() );
			} );
			$( this ).next( '.sortable-input' ).val( items.join( ',' ) ).trigger( 'change' );
		}
	} );

	$( '.dashicons-visibility' ).on( 'click', function( e ) {
		var items = [];
			_this = $( this );
		_this.toggleClass( 'visible invisible' );
		_this.parent().toggleClass( 'visible invisible' );
		_this.closest( '.sortable-list' ).find( 'li.visible' ).each( function() {
			items.push( $( this ).data( 'key' ).trim() );
		} );
		_this.closest( '.sortable-list' ).next( '.sortable-input' ).val( items.join( ',' ) ).trigger( 'change' );
	} );

} );
