jQuery( document ).ready( function( $ ) {

	var article = $( '#article' );
		post_id = article.data( 'object-id' );
		updated = false;

	if ( article.length === 0 ) {
		return;
	}

	setTimeout( function() {

		$( window ).scroll( function() {

			var scrollPosition = $( window ).scrollTop(); // Calculate the scroll position.
				articleHeight  = article.height(); // Calculate the height of the article.
				viewportHeight = $( window ).height(); // Calculate the height of the viewport.

			// Check if the user has reached the bottom of the article
			if ( scrollPosition + viewportHeight >= articleHeight && updated === false ) {

				if ( ! article.hasClass( 'processing' ) ) {
					$.ajax( {
						url: ajax_obj.url, // Ajax url from function ajax_localize_params().
						type:'POST',
						data: {
							'action': 'postviews_handler', // Handler name.
							'post_id': post_id,
						},
						beforeSend: function() {
							article.addClass( 'processing' );
						},
						complete: function() {
							article.removeClass( 'processing' );
						},
						success:function( response ) {

							if ( response.success ) {

								updated = true;

								var postmeta     = article.find( '.post-entry-meta-item.icon-eye' )
									currentValue = parseInt( postmeta.text() );

								// Update the HTML with the new value.
								postmeta.text( currentValue + 1 );

								console.log( 'Added new post view' );

							} else {
							}
						}
					} );
				}
			}
		} );

	}, 5000 );

} );
