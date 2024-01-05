/**
 * Subscribe form js handler
 *
 * Form js handler  - /assets/js/source/ajax-loadmore.js
 * Setup js scripts - /inc/setup.php
 * Form php handler - /inc/handlers.php
 * Html             - /templates/archive/archive-pagination.php
 */

jQuery( document ).ready( function( $ ) {

	function checkLoadingPages() {
		var btn = $( '.loadmore' );
		if ( btn.length > 0 ) {
			btn.each( function() {
				if ( $(this).data( 'current-page' ) >= $(this).data( 'max-pages' ) ) {
					$(this).text( $(this).data( 'disabled-text' ) );
					$(this).attr( 'disabled', true );
				}
			} );
		}
	}

	checkLoadingPages();

	$( '#primary' ).on( 'click', '.loadmore', function( e ) {

		var btn          = $( this );
			container    = $( e.delegateTarget ).find( '.loop' );
			defaultText  = btn.data( 'default-text' );
			loadingText  = btn.data( 'loading-text' );
			disabledText = btn.data( 'disabled-text' );
			currentPage  = btn.data( 'current-page' );

		if ( ! btn.hasClass( 'processing' ) ) {
			$.ajax( {
				url: ajax_obj.url, // Ajax url from function ajax_localize_params().
				type:'POST',
				data: {
					'action': 'loadmore_handler', // Handler name.
					'query': ajax_obj.query, // Query from function ajax_localize_params().
					'page': currentPage,
				},
				beforeSend: function() {
					btn.addClass( 'processing' ).addClass( 'icon-loading' ).text( loadingText );
				},
				complete: function() {
					btn.removeClass( 'processing' ).removeClass( 'icon-loading' ).text( defaultText );
					btn.data( 'current-page', parseInt( currentPage + 1 ) );

					checkLoadingPages();

					if ( container.hasClass( 'masonry-gallery' ) ) {
						container.masonry( 'reloadItems' );
						container.masonry( {
							columnWidth: '.masonry-item',
							itemSelector: '.masonry-item',
						} );
					}

					$( '.post-gallery-slider' ).slick();
				},
				success:function( response ) {
					if ( response.success ) {
						container.append( response.data );
					}
				}
			} );
		}

		e.preventDefault();
	} );
} );
