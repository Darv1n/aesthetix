/**
 * Subscription form js handler
 *
 * Form js handler  - /assets/js/source/loadmore.js
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
			});
		}
	}

	checkLoadingPages();

	$( '#primary' ).on( 'click', '.loadmore', function( e ) {

		var btn          = $( this );
			container    = $( e.delegateTarget ).find( '.loop' );
			defaultIcon  = btn.data( 'default-icon' );
			loadingIcon  = btn.data( 'loading-icon' );
			defaultText  = btn.data( 'default-text' );
			loadingText  = btn.data( 'loading-text' );
			disabledText = btn.data( 'disabled-text' );
			currentPage  = btn.data( 'current-page' );

		if ( ! btn.hasClass( 'processing' ) ) {
			$.ajax({
				url: ajax_obj.url, // путь до ajax.
				type:'POST', // тип запроса.
				data: {
					'action': 'loadmore_handler', // обработчик.
					'query': ajax_obj.query,
					'page': currentPage,
				},
				beforeSend: function() {
					btn.addClass( 'processing' ).removeClass( defaultIcon ).addClass( loadingIcon ).text( loadingText );
				},
				complete: function() {
					btn.removeClass( 'processing' ).removeClass( loadingIcon ).addClass( defaultIcon ).text( defaultText );
					btn.data( 'current-page', parseInt( currentPage + 1 ) );

					checkLoadingPages();

					if ( container.hasClass( 'masonry-gallery' ) ) {
						container.masonry( 'reloadItems' );
						container.masonry({
							columnWidth: '.masonry-item',
							itemSelector: '.masonry-item',
						});
					}
				},
				success:function( response ) {
					// console.log( response.data );
					if ( response.success ) {
						container.append( response.data );
					}
				}
			});
		}

		e.preventDefault();
	});
});
